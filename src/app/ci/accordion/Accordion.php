<?php
namespace ci\accordion;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use n2n\persistence\orm\annotation\AnnoOrderBy;
use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\reflection\ObjectAdapter;

class Accordion extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('contentItems', new AnnoOneToMany(ContentItem::getClass(), null, \n2n\persistence\orm\CascadeType::ALL, null, true), new AnnoOrderBy(array('orderIndex' => 'ASC')));
	}

	private $id;
	private $title;
/**
     * @var ContentItem[]
     */
	private $contentItems = array();

	public function getId() {

    	return $this->id;
	}

	public function setId(int $id = null) {

    	$this->id = $id;
	}

	/**
     * @return string
     */
	public function getTitle() {

        return $this->title;
	}

	/**
     * @param string $title
     */
	public function setTitle(string $title = null) {

        $this->title = $title;
	}

	/**
	 * @return ContentItem[]
	 */
	public function getContentItems() {

        return $this->contentItems;
	}

	/**
     * @param ContentItem[] $contentItems
     */
	public function setContentItems($contentItems) {

        $this->contentItems = $contentItems;
	}
}