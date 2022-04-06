<?php
namespace ci\cta;

use n2n\web\http\orm\ResponseCacheClearer;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use rocket\impl\ei\component\prop\ci\model\ContentItem;
use bstmpl\bo\util\SimplePageLink;
use n2n\persistence\orm\annotation\AnnoOneToOne;

class CiCta extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('link', new AnnoOneToOne(SimplePageLink::getClass(), null, \n2n\persistence\orm\CascadeType::ALL, null, true));
	}

	private $title;
	private $intro;
	private $phone;
	private $email;
	private $link;

	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\ci\cta\ciCta.html', array('ciCta' => $this));
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle(string $title = null) {
		$this->title = $title;
	}

	public function getIntro() {
		return $this->intro;
	}

	public function setIntro(string $intro = null) {
		$this->intro = $intro;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone(string $phone = null) {
		$this->phone = $phone;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail(string $email = null) {
		$this->email = $email;
	}

	public function getLink() {
		return $this->link;
	}

	public function setLink(SimplePageLink $link = null) {
		$this->link = $link;
	}
	
	public function hasContactItems() {
		return (null !== $this->email || null !== $this->phone || null !== $this->link);
	}
}