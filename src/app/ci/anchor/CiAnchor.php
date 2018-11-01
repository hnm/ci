<?php
namespace ci\anchor;

use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\impl\web\ui\view\html\HtmlElement;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class CiAnchor extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
	}
	
	private $title;
	private $pathPart;
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getPathPart() {
		return $this->pathPart;
	}

	public function setPathPart($pathPart) {
		$this->pathPart = $pathPart;
	}
	
	public function createUiComponent(HtmlView $view) {
		$anchorState = $view->lookup(AnchorState::class);
		$view->assert($anchorState instanceof AnchorState);
		
		$id = $anchorState->addAnchor($this->pathPart, $this->title);
		return new HtmlElement('div', array('id' => $id, 'class' => 'ci-anchor'), '');
	}
}