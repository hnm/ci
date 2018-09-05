<?php
namespace ci\bo;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use ci\bo\columns\NestedContentItem;

class CiYoutube extends NestedContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
	}
	
	private $youtubeId;
	private $nestedCiType;
	
	public function setYoutubeId($youtubeId) {
		$this->youtubeId = $youtubeId;
	}
	
	public function getYoutubeId() {
		return $this->youtubeId;
	}
	
	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\ci\view\ciYoutube.html', array('youtube' => $this));
	}
	
	public function getNestedCiType() {
		return $this->nestedCiType;
	}
	
	public function setNestedCiType($nestedCiType) {
		$this->nestedCiType = $nestedCiType;
	}
	

}