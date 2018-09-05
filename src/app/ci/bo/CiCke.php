<?php
namespace ci\bo;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\impl\web\ui\view\html\HtmlElement;
use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use ci\bo\columns\NestedContentItem;
use n2n\persistence\orm\annotation\AnnoTransient;

class CiCke extends NestedContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('nestedCiType', new AnnoTransient());
	}
	
	private $contentHtml;
	private $nestedCiType;
	
	public function setContentHtml($contentHtml) {
		$this->contentHtml = $contentHtml;
	}
	
	public function getContentHtml() {
		return $this->contentHtml;
	}
	
	public function createUiComponent(HtmlView $view) {
		$ckeHtml = new CkeHtmlBuilder($view);
		return new HtmlElement('div', array('class' => 'ci-cke'), $ckeHtml->getOut($this->contentHtml));
	}
	
	public function getNestedCiType() {
		return $this->nestedCiType;
	}

	public function setNestedCiType($nestedCiType) {
		$this->nestedCiType = $nestedCiType;
	}
}