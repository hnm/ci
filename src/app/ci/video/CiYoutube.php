<?php
namespace ci\video;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use ci\columns\NestedContentItem;

class CiYoutube extends NestedContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
	}

	private $title;
	private $youtubeId;
	private $nestedCiType;

	public function setYoutubeId(string $youtubeId = null) {

		$this->youtubeId = $youtubeId;
	}

	public function getYoutubeId() {

		return $this->youtubeId;
	}

	public function getNestedCiType() {

		return $this->nestedCiType;
	}

	public function setNestedCiType(string $nestedCiType = null) {

		$this->nestedCiType = $nestedCiType;
	}

	public function createUiComponent(HtmlView $view) {

		return $view->getImport('\ci\video\ciYoutube.html', array('ciYoutube' => $this));
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle(string $title = null) {
		$this->title = $title;
	}
}