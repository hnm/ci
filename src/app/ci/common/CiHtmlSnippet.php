<?php
namespace ci\common;

use n2n\web\ui\Raw;
use n2n\impl\web\ui\view\html\HtmlView;
use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class CiHtmlSnippet extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
	}
	
	private $html;
	
	public function setHtml($html) {
		$this->html = $html;
	}
	
	public function gethtml() {
		return $this->html;
	}
	
	public function createUiComponent(HtmlView $view) {
		return new Raw($this->html); 
	}
}