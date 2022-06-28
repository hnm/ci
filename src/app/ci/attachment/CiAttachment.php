<?php
namespace ci\attachment;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManagedFile;
use n2n\io\managed\File;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use rocket\impl\ei\component\prop\ci\model\ContentItem;

class CiAttachment extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('attachments', new AnnoOneToMany(Attachment::getClass(), null, \n2n\persistence\orm\CascadeType::ALL, null, true));
	}

	private $title;
	private $attachments;

	public function getLabel() {

		if (null === $this->title && null !== $this->file && $this->file->isValid()) {
			return $this->file->getOriginalName();
		}
		return $this->title;
	}

	public function createUiComponent(HtmlView $view) {

		return $view->getImport('\ci\attachment\ciAttachment.html', array('ciAttachment' => $this));
	}

	public function getTitle() {

		return $this->title;
	}

	public function setTitle(string $title = null) {

		$this->title = $title;
	}

	/**
	 * @return Attachment[]
	 */
	public function getAttachments() {
		return $this->attachments;
	}

	public function setAttachments($attachments) {
		$this->attachments = $attachments;
	}
}