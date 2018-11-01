<?php
namespace ci\gmap;

use n2n\web\http\orm\ResponseCacheClearer;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use rocket\impl\ei\component\prop\ci\model\ContentItem;

class CiSimpleMap extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
	}

	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\ci\gmap\ciSimpleMap.html', array('ciSimpleMap' => $this));
	}
}