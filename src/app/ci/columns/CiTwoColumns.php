<?php
namespace ci\columns;

use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use n2n\persistence\orm\annotation\AnnoOrderBy;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\reflection\CastUtils;

class CiTwoColumns extends ContentItemContainer {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('ci_two_columns'), new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('contentItems', new AnnoOneToMany(NestedContentItem::getClass(), null, CascadeType::ALL, null, true), 
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
		$index = 0;
		foreach ($this->contentItems as $contentItem) {
			CastUtils::assertTrue($contentItem instanceof NestedContentItem);
			$contentItem->setContentItemContainer($this);
		}
		return $this->contentItems;
	}

	public function setContentItems($contentItems) {
		$this->contentItems = $contentItems;
	}

	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\ci\columns\ciTwoColumns.html', array('ciTwoColumns' => $this));
	}
	
	public function getPanels() {
		return NestedContentItem::getPanelsTwoCol();
	}
	
	public function getNestedCiType() {
		return NestedContentItem::NESTED_TWO_COLUMNS;
	}
}