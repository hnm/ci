<?php
namespace ci\bo\image;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use \n2n\io\managed\File;
use n2n\persistence\orm\annotation\AnnoManagedFile;
use n2nutil\bootstrap\img\MimgBs;
use n2n\impl\web\ui\view\html\img\Mimg;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\persistence\orm\annotation\AnnoOneToOne;
use n2n\persistence\orm\CascadeType;
use n2n\impl\web\ui\view\html\HtmlUtils;
use n2n\impl\web\ui\view\html\img\ImgComposer;
use ch\hnm\util\page\bo\ExplPageLink;
use page\bo\util\PageLink;
use rocket\ei\manage\preview\model\PreviewModel;
use ci\columns\NestedContentItem;

class CiImage extends NestedContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('explPageLink', new AnnoOneToOne(ExplPageLink::getClass(), null, CascadeType::ALL, null, true));
		$ai->p('fileImage', new AnnoManagedFile());
	}
	
	const ALIGN_LEFT = 'left';
	const ALIGN_CENTER = 'center';
	const ALIGN_RIGHT = 'right';
	const CSS_CLASS_PREFIX = 'ci-image-';
	const FORMAT_LANDSCAPE = 'landscape';
	const FORMAT_PORTRAIT = 'portrait';
	
	const IMAGE_FACTOR_SMALL= 0.6;
	const IMAGE_ASPEKT_RATIO = 3/2;
	
	private $nestedCiType;
	private $fileImage;
	private $caption;
	private $altTag;
	private $alignment;
	private $openLytebox = false;
	private $format;
	private $explPageLink;
	
	/**
	 * @return File
	 */
	public function getFileImage() {
		return $this->fileImage;
	}
	
	/**
	 * @param File $fileImage
	 */
	public function setFileImage(File $fileImage) {
		$this->fileImage = $fileImage;
	}
	
	public function getCaption() {
		return $this->caption;
	}
	
	public function setCaption($caption) {
		$this->caption = $caption;
	}
	
	public function isOpenLytebox() {
		return (bool) $this->openLytebox;
	}
	
	public function setOpenLytebox($openLytebox) {
		$this->openLytebox = $openLytebox;
	}
	
	public function getAlignment() {
		return $this->alignment;
	}
	
	public function setAlignment($alignment) {
		$this->alignment = $alignment;
	}
	
	public function getAltTag() {
		return $this->altTag;
	}
	
	public function setAltTag($altTag) {
		$this->altTag = $altTag;
	}
	
	public function getFormat() {
		return $this->format;
	}
	
	public function setFormat($format) {
		$this->format = $format;
	}
	
	public function getExplPageLink() {
		return $this->explPageLink;
	}
	
	public function setExplPageLink(ExplPageLink $explPageLink = null) {
		$this->explPageLink = $explPageLink;
	}
	
	public function getNestedCiType() {
		return $this->nestedCiType;
	}
	
	public function setNestedCiType($nestedCiType) {
		$this->nestedCiType = $nestedCiType;
	}
	
	public function determineTarget() {
		if (null !== $this->explPageLink && $this->explPageLink->getType() == PageLink::TYPE_EXTERNAL) {
			return '_blank';
		}
		return null;
	}
	
	public function determineRel() {
		if (null !== $this->explPageLink && $this->explPageLink->getType() == PageLink::TYPE_EXTERNAL) {
			return 'noopener';
		}
		return null;
	}
	
	public function determineAltTag() {
		if ($this->altTag) return $this->altTag;
		if ($this->caption) return $this->caption;
		if ($this->fileImage && $this->fileImage->isValid()) return $this->fileImage->getOriginalName();
		return '';
	}
	
	public function isAlignmentApplied() {
		return strlen($this->alignment) > 0;
	}
	
	public function getContainerAttrs(array $attrs = null, $overwrite = false) {
		$baseAttrs = array('class' => 'ci-image');
		
		if (null !== $this->getCssFormatClass()) {
			$baseAttrs = HtmlUtils::mergeAttrs($baseAttrs, array('class' => $this->getCssFormatClass()));
		}
		
		if (null !== $this->getCssAlignmentClass()) {
			$baseAttrs = HtmlUtils::mergeAttrs($baseAttrs, array('class' => $this->getCssAlignmentClass()));
			
		}
		
		
		$baseAttrs = HtmlUtils::mergeAttrs($baseAttrs, (array) $attrs, $overwrite);
		
		return $baseAttrs;
	}
	
	public function getCssAlignmentClass() {
		$alignmentClass = null;
		switch ($this->alignment) {
			case CiImage::ALIGN_CENTER:
				$alignmentClass = self::CSS_CLASS_PREFIX . 'c';
				break;
			case CiImage::ALIGN_LEFT:
				$alignmentClass = self::CSS_CLASS_PREFIX . 'l';
				break;
			case CiImage::ALIGN_RIGHT:
				$alignmentClass = self::CSS_CLASS_PREFIX . 'r';
				break;
			default:
				$alignmentClass = null;
		}
		return $alignmentClass;
	}
	
	public function getCssFormatClass() {
		$formatClass = null;
		
		if($this->format === self::FORMAT_PORTRAIT) {
			$formatClass = self::CSS_CLASS_PREFIX . 'portrait';
		}
		
		return $formatClass;
	}
	
	public function getImgComposer() {
		$imgComposer = null;
		
		if ($this->getPanel() === 'aside') {
			return MimgBs::xs(Mimg::crop(263, 176));
		}
		
		$imgWidth = array('xs' => 545, 'sm' => 510);
		
		if (null !== $this->nestedCiType) {
			
			switch($this->nestedCiType) {
				case self::NESTED_TWO_COLUMNS:
					$imgWidth = array_merge($imgWidth, array('md' => 320, 'lg' => 450, 'xl' => 540));
					break;
					
				case self::NESTED_THREE_COLUMNS:
					$imgWidth = array_merge($imgWidth, array('md' => 210, 'lg' => 290, 'xl' => 350));
					break;
			}
		} else {
			$imgWidth = array_merge($imgWidth, array('md' => 690, 'lg' => 770, 'xl' => 823));
		}
		
		$imgComposer = $this->createImgComposer($imgWidth);
		
		return $imgComposer;
	}
	
	private function createImgComposer(array $widths) {
		
		$imgVariations = array();
		foreach ($widths as $key => $width) {
			$tmpWidth =  (int) round($width * $this->determineWidthMultiplier($key));
			$imgVariations[$key] = array(
					'width' => $tmpWidth,
					'height' => $this->calcHeight($tmpWidth)
			);
		};
		
		$imgComposer = $this->createImgComposerVariations($imgVariations, $this->isCrop());
		
		
		return $imgComposer;
	}
	
	private function isCrop() {
		if (null === $this->format) return false;
		
		return true;
	}
	
	private function determineWidthMultiplier(string $resolution) {
		// Immer wenn die auflösung grösser als md und
		if (in_array($resolution, ['md', 'lg', 'xl'])) {
			// das bild ausgerichtet ist dann auf eine bestimmte breite
			if ($this->isAlignmentApplied()) return self::IMAGE_FACTOR_SMALL;
			
			// im Hochformat ist dann nur so breit wie im querformat die höhe ist
			if ($this->isPortrait()) return 1 / self::IMAGE_ASPEKT_RATIO;
		}
		
		return 1;
	}
	
	private function calcHeight(string $width) {
		if ($this->format === self::FORMAT_LANDSCAPE) return $width / self::IMAGE_ASPEKT_RATIO;
		
		
		return $width * self::IMAGE_ASPEKT_RATIO;
	}
	
	private function createImgComposerVariations(array $variations, $crop = true) {
		$xs = array_shift($variations);
		
		$imgComposer = MimgBs::xs($crop ?
				Mimg::crop($xs['width'], $xs['height'], true) : Mimg::prop($xs['width'], $xs['height'], false));
		
		if (isset($variations['sm'])) {
			$imgComposer->sm($variations['sm']['width']);
		}
		
		if (isset($variations['md'])) {
			$imgComposer->md($variations['md']['width']);
		}
		
		if (isset($variations['lg'])) {
			$imgComposer->lg($variations['lg']['width']);
		}
		
		if (isset($variations['xl'])) {
			$imgComposer->xl($variations['xl']['width']);
		}
		
		
		return $imgComposer;
	}
	
	public function isPortrait() {
		return $this->format === self::FORMAT_PORTRAIT;
	}
	
	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\ci\view\image\ciImage.html', array('image' => $this));
	}
	
	public function createEditablePreviewUiComponent(PreviewModel $previewModel,HtmlView $view) {
		return null;
	}
}