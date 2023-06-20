<?php
namespace ci\article;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\io\managed\File;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoManagedFile;
use n2n\persistence\orm\annotation\AnnoOneToOne;
use ch\hnm\util\page\bo\ExplPageLink;
use n2n\persistence\orm\CascadeType;
use n2n\l10n\N2nLocale;
use page\bo\util\PageLink;
use ci\columns\NestedContentItem;
use n2n\reflection\annotation\AnnoInit;
use rocket\attribute\EiType;

#[EiType(label:'Artikel')]
class CiArticle extends NestedContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('explPageLink', new AnnoOneToOne(ExplPageLink::getClass(), null, CascadeType::ALL, null, true));
		$ai->p('fileImage', new AnnoManagedFile());
	}
	
	private $title;
	private $descriptionHtml;
	private $altTag;
	private $fileImage;
	private $picPos;
	private $openLytebox = false;
	private $explPageLink;
	
	const PIC_POS_LEFT = 'left';
	const PIC_POS_RIGHT = 'right';
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getDescriptionHtml() {
		return $this->descriptionHtml;
	}
	
	public function setDescriptionHtml($descriptionHtml) {
		$this->descriptionHtml = $descriptionHtml;
	}
	
	public function getAltTag() {
	    return $this->altTag;
	}
	
	public function setAltTag($altTag) {
	    $this->altTag = $altTag;
	}
	
	public function getFileImage() {
		return $this->fileImage;
	}
	
	public function setFileImage(File $fileImage) {
		$this->fileImage = $fileImage;
	}
	
	public function getExplPageLink() {
		return $this->explPageLink;
	}
	
	public function setExplPageLink(ExplPageLink $explPageLink = null) {
		$this->explPageLink = $explPageLink;
	}
	
	public function setPicPos($picPos) {
		if (!in_array($picPos, array(self::PIC_POS_LEFT, self::PIC_POS_RIGHT))) {
			throw new \InvalidArgumentException($picPos . ' is not a valid value for picPos');
		}
		$this->picPos = $picPos;
	}
	
	public function getPicPos() {
		return $this->picPos;
	}
	
	public function isOpenLytebox() {
		return (bool) $this->openLytebox;
	}

	public function setOpenLytebox($openLytebox) {
		$this->openLytebox = $openLytebox;
	}

	public function hasTitle() {
		return (bool) $this->title;
	}
	
	public function getDisplayLabel(N2nLocale $n2nLocale) {
	    if (null !== $this->explPageLink) {
	        if (null !== $this->explPageLink->getLabel()) return $this->explPageLink->getLabel();
	        if (null !== $this->explPageLink->getLinkedPage()) return $this->explPageLink->getLinkedPage()->t($n2nLocale)->getName();
	        if (null !== $this->explPageLink->getUrl()) return $this->explPageLink->getUrl();
	    }
	    return null;
	}
	
	public function determineAltTag() {
		if ($this->altTag) return $this->altTag;
		
		return $this->title;
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

	public function createUiComponent(HtmlView $view) {
		if (in_array($this->getPanel(), NestedContentItem::getValidPanels())) {
			return $view->getImport('\ci\article\ciArticleNested.html', array('article' => $this));
		}
		
		return $view->getImport('\ci\article\ciArticle.html', array('article' => $this));
	}
}
