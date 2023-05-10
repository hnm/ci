<?php
namespace ci\columns;

use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\annotation\AnnoOrderBy;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\util\type\CastUtils;

class CiTwoColumns extends ContentItemContainer {
	
			
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('ci_two_columns'), new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('contentItems', new AnnoOneToMany(NestedContentItem::getClass(), null, \n2n\persistence\orm\CascadeType::ALL, null, true), new AnnoOrderBy(array('orderIndex' => 'ASC')));
	}

/**
	 * @var ContentItem[]
	 */
	private $contentItems = array();
	private $splitting;
	private $alignment;

	/**
	 * @return NestedContentItem[]
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

	public function getAlignmentClass() {
		switch ($this->alignment) {
			case NestedContentItem::ALIGNMENT_BOTTOM: return ' align-items-end';
			case NestedContentItem::ALIGNMENT_CENTER: return ' align-items-center';
			default: return null;
		}
	}
	
	public function getClassForPanel($panelName) {
		if ($this->splitting === null) {
			return 'col-md-6';
		}
		
		if ($this->splitting === NestedContentItem::SPLITTING_THREE_TWO) {
			if ($panelName === NestedContentItem::NESTED_PANEL_NAME_1) {
				return 'col-md-8';
			}
			if ($panelName === NestedContentItem::NESTED_PANEL_NAME_2) {
				return 'col-md-4';
			}
		}
		
		if ($this->splitting === NestedContentItem::SPLITTING_TWO_THREE) {
			if ($panelName === NestedContentItem::NESTED_PANEL_NAME_1) {
				return 'col-md-4';
			}
			if ($panelName === NestedContentItem::NESTED_PANEL_NAME_2) {
				return 'col-md-8';
			}
		}
	}
	

	public function getAlignment() {
		return $this->alignment;
	}

	public function setAlignment(?string $alignment) {
		$this->alignment = $alignment;
	}

	public function getSplitting() {
		return $this->splitting;
	}

	public function setSplitting(string $splitting = null) {
		$this->splitting = $splitting;
	}
}