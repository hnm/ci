<?php
namespace ci\cke;

use n2n\impl\web\ui\view\html\HtmlView;
use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use ci\columns\NestedContentItem;
use ci\ui\CiUtils;
use rocket\attribute\EiType;

#[EiType(label:'Text Editor')]
class CiCke extends NestedContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
	}
	
	private $contentHtml;
	
	public function setContentHtml($contentHtml) {
		$this->contentHtml = $contentHtml;
	}
	
	public function getContentHtml() {
		return $this->contentHtml;
	}
	
	public function createUiComponent(HtmlView $view) {
		$ckeHtml = new CkeHtmlBuilder($view);
		return $ckeHtml->getOut(CiUtils::getParsedHtml($this->contentHtml));
	}
}
