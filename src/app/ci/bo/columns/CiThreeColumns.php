<?php

namespace ci\bo\columns;

use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use n2n\persistence\orm\annotation\AnnoOrderBy;
use n2n\persistence\orm\annotation\AnnoTable;
use ci\bo\columns\NestedContentItem;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class CiThreeColumns extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('ci_three_columns'), new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('contentItems', new AnnoOneToMany(ContentItem::getClass(), null, CascadeType::ALL, null, true),
				new AnnoOrderBy(array('orderIndex' => 'ASC')));
	}
	
	/**
	 * @var ContentItem[]
	 */
	private $contentItems = array();
	
	/**
	 * @return ContentItem []
	 */
	public function getContentItems() {
		foreach ($this->contentItems as $contentItem) {
			if ($contentItem instanceof NestedContentItem) {
				$contentItem->setNestedCiType(NestedContentItem::NESTED_THREE_COLUMNS);
			}
		}
		return $this->contentItems;
	}
	
	public function setContentItems($contentItems) {
		$this->contentItems = $contentItems;
	}
	
	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\ci\view\columns\ciThreeColumns.html', array('ciThreeColumns' => $this));
	}
	
	public function getPanels() {
		return NestedContentItem::getPanelsThreeCol();
	}
}