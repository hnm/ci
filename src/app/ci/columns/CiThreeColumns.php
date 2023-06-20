<?php
namespace ci\columns;

use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use n2n\persistence\orm\annotation\AnnoOrderBy;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\reflection\annotation\AnnoInit;
use rocket\attribute\EiType;

#[EiType(label:'3 Spalten')]
class CiThreeColumns extends ContentItemContainer {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('ci_three_columns'), new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('contentItems', new AnnoOneToMany(NestedContentItem::getClass(), null, CascadeType::ALL, null, true),
				new AnnoOrderBy(array('orderIndex' => 'ASC')));
	}
	
	/**
	 * @var ContentItem[]
	 */
	private $contentItems = array();
	private $alignment;
	
	/**
	 * @return ContentItem []
	 */
	public function getContentItems() {
		foreach ($this->contentItems as $contentItem) {
			if ($contentItem instanceof NestedContentItem) {
				$contentItem->setContentItemContainer($this);
			}
		}
		return $this->contentItems;
	}
	
	public function setContentItems($contentItems) {
		$this->contentItems = $contentItems;
	}
	
	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\ci\columns\ciThreeColumns.html', array('ciThreeColumns' => $this));
	}
	
	public function getPanels() {
		return NestedContentItem::getPanelsThreeCol();
	}
	
	public function getNestedCiType() {
		return NestedContentItem::NESTED_THREE_COLUMNS;
	}
	
	public function getAlignmentClass() {
		switch ($this->alignment) {
			case NestedContentItem::ALIGNMENT_BOTTOM: return ' align-items-end';
			case NestedContentItem::ALIGNMENT_CENTER: return ' align-items-center';
			default: return null;
		}
	}
	
	public function getAlignment() {
		return $this->alignment;
	}
	
	public function setAlignment(string $alignment) {
		$this->alignment = $alignment;
	}
}