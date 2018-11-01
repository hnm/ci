<?php
namespace ci\common;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\core\N2N;
use n2n\impl\web\ui\view\html\HtmlElement;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManagedFile;
use n2n\io\managed\File;
use n2n\impl\web\ui\view\html\HtmlUtils;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use rocket\impl\ei\component\prop\ci\model\ContentItem;

class CiAttachment extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('file', new AnnoManagedFile());
	}
	
	private $name;
	private $description;
	private $file;
	
	public function getName() {
		return $this->name;
	}

	public function setName($name = null) {
		$this->name = $name;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description = null) {
		$this->description = $description;
	}

	public function getFile() {
		return $this->file;
	}

	public function setFile(File $file) {
		$this->file = $file;
	}
	
	public function getLabel() {
		if (null === $this->name) {
			return $this->file->getOriginalName();
		}
		return $this->name;
	}

	public function createUiComponent(HtmlView $view) {
		$aAttr = array('target' => 'blank', 'class' => 'file');
		if (null !== $this->file) {
			$aAttr = HtmlUtils::mergeAttrs($aAttr, array('class' => $this->file->getOriginalExtension()));
		}
		
		$div = new HtmlElement('div', array('class' => 'ci-attachment'));
		if (N2N::isDevelopmentModeOn() && $this->file === null) {
		    $div->appendContent($this->getLabel());
		} else {
    		$div->appendContent($view->getHtmlBuilder()->getLink(
    				$this->file, $this->getLabel(), $aAttr));
		}
		
		if (null !== ($desc = $this->getDescription())) {
			$div->appendContent(new HtmlElement('p', null, $desc));
		}
		return $div;
	}
}