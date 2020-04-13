<?php
namespace ci\image;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use \n2n\io\managed\File;
use n2n\persistence\orm\annotation\AnnoManagedFile;
use bootstrap\img\MimgBs;
use n2n\impl\web\ui\view\html\img\Mimg;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\persistence\orm\annotation\AnnoOneToOne;
use n2n\persistence\orm\CascadeType;
use n2n\impl\web\ui\view\html\HtmlUtils;
use ch\hnm\util\page\bo\ExplPageLink;
use page\bo\util\PageLink;
use rocket\ei\manage\preview\model\PreviewModel;
use ci\columns\NestedContentItem;
use ci\columns\CiTwoColumns;
use n2n\util\type\CastUtils;

class CiImage extends NestedContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('explPageLink', new AnnoOneToOne(ExplPageLink::getClass(), null, CascadeType::ALL, null, true));
		$ai->p('fileImage', new AnnoManagedFile());
	}
	
	const ALIGN_LEFT = 'left';
	const ALIGN_CENTER = 'center';
	const ALIGN_RIGHT = 'right';
	const ALIGN_FULL_WIDTH = 'full-width';
	const CSS_CLASS_PREFIX = 'ci-image-';
	const FORMAT_LANDSCAPE = 'landscape';
	const FORMAT_PORTRAIT = 'portrait';
	
	const IMAGE_FACTOR_SMALL= 0.6;
	
	const IMAGE_ASPEKT_RATIO_FULL_WIDTH = 4/1;
	const IMAGE_ASPEKT_RATIO = 4/3;
	
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
		
		if (!$this->isNested() && !$this->isAside() && $this->alignment === self::ALIGN_FULL_WIDTH) {
			$baseAttrs = HtmlUtils::mergeAttrs($baseAttrs, array('class' => 'ci-item-full-width'));
		} else {
			$baseAttrs = HtmlUtils::mergeAttrs($baseAttrs, array('class' => $this->isNested() ? 'ci-item-nested' : 'ci-item'));
		}
		
		
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
			case CiImage::ALIGN_FULL_WIDTH:
				if (!$this->isNested() && !$this->isAside()) {
					$alignmentClass = self::CSS_CLASS_PREFIX . 'full-width';
				}
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
		
		
		if (!$this->isNested() && !$this->isAside() && $this->alignment === self::ALIGN_FULL_WIDTH) {
			$imageFullWidth = 575;
			return MimgBs::xs(Mimg::crop($imageFullWidth, ($imageFullWidth /self::IMAGE_ASPEKT_RATIO_FULL_WIDTH)))->sm(767)->md(991)->lg(1199)->xl(1920);
		}
		
		if ($this->isAside()) {
			return MimgBs::xs(Mimg::crop(263, 176));
		}
		
		
		// mobile 
		$imgWidth = array('xs' => 545, 'sm' => 510);
		
		if (null !== $this->getNestedCiType()) {
			
			switch($this->getNestedCiType()) {
				case self::NESTED_TWO_COLUMNS:
					
					$contentItemContainer = $this->getContentItemContainer();
					CastUtils::assertTrue($contentItemContainer instanceof CiTwoColumns);
					
				    // 2 Spalten
					if ($this->getContentItemContainer()->getSplitting() === null) {
						$imgWidth = array_merge($imgWidth, array('md' => 330, 'lg' => 450, 'xl' => 540));
						break;
					}
					
					// Layout/Splitting 3:2 <-> 2:3
					if ($this->getPanel() === NestedContentItem::NESTED_PANEL_NAME_1 && $this->getContentItemContainer()->getSplitting() === NestedContentItem::SPLITTING_THREE_TWO ||
							$this->getPanel() === NestedContentItem::NESTED_PANEL_NAME_2 && $this->getContentItemContainer()->getSplitting() === NestedContentItem::SPLITTING_TWO_THREE) {
				    	$imgWidth = array_merge($imgWidth, array('md' => 450, 'lg' => 610, 'xl' => 730));
				    	break;
					}
					
					if ($this->getPanel() === NestedContentItem::NESTED_PANEL_NAME_1 && $this->getContentItemContainer()->getSplitting() === NestedContentItem::SPLITTING_TWO_THREE ||
							$this->getPanel() === NestedContentItem::NESTED_PANEL_NAME_2 && $this->getContentItemContainer()->getSplitting() === NestedContentItem::SPLITTING_THREE_TWO) {
						$imgWidth = array_merge($imgWidth, array('md' => 210, 'lg' => 290, 'xl' => 350));
						break;
					}
							
					
				case self::NESTED_THREE_COLUMNS:
				    // 3 Spalten
					$imgWidth = array_merge($imgWidth, array('md' => 210, 'lg' => 290, 'xl' => 350));
					break;
			}
		} else {
		    // volle Breite
			$imgWidth = array_merge($imgWidth, array('md' => 690, 'lg' => 930, 'xl' => 1110));
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
	
	
	public function isAside() {
		return $this->getPanel() === 'aside';
	}
	
	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\ci\image\ciImage.html', array('image' => $this));
	}
	
	public function createEditablePreviewUiComponent(PreviewModel $previewModel,HtmlView $view) {
		return null;
	}
}
