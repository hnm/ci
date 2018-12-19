<?php
namespace ci\common;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManagedFile;
use n2n\io\managed\File;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use ci\columns\NestedContentItem;

class CiAttachment extends NestedContentItem {
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
		if (null === $this->name && null !== $this->file && $this->file->isValid()) {
			return $this->file->getOriginalName();
		}
		return $this->name;
	}

	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\ci\common\ciAttachment.html', array('ciAttachment' => $this));
	}
}