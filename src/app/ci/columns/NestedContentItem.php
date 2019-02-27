<?php
namespace ci\columns;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoTransient;
use n2n\persistence\orm\annotation\AnnoTable;
use rocket\impl\ei\component\prop\ci\model\ContentItem;

abstract class NestedContentItem extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('ci_nested_content_item'));
		//$ai->c(new AnnoMappedSuperclass());
		
		$ai->p('contentItemContainer', new AnnoTransient());
	}
	
	const NESTED_TWO_COLUMNS = 'nested-two-columns';
	const NESTED_THREE_COLUMNS = 'nested-three-columns';
	
	const NESTED_PANEL_NAME_1 = 'column-1';
	const NESTED_PANEL_NAME_2 = 'column-2';
	const NESTED_PANEL_NAME_3 = 'column-3';
	
	private $contentItemContainer;
	
	static function getConstants() {
		$oClass = new \ReflectionClass(__CLASS__);
		return $oClass->getConstants();
	}
	
	static function getPanelsTwoCol() {
		return array(self::NESTED_PANEL_NAME_1, self::NESTED_PANEL_NAME_2);
	}
	
	static function getPanelsThreeCol() {
		return array(self::NESTED_PANEL_NAME_1, self::NESTED_PANEL_NAME_2, self::NESTED_PANEL_NAME_3);
	}
	
	static function getValidPanels() {
		return array(self::NESTED_PANEL_NAME_1, self::NESTED_PANEL_NAME_2, self::NESTED_PANEL_NAME_3);
	}
	
	public function getContentItemContainer() {
		return $this->contentItemContainer;
	}

	public function setContentItemContainer(ContentItemContainer $contentItemContainer = null) {
		$this->contentItemContainer = $contentItemContainer;
	}

	public function getNestedCiType() {
		if (null === $this->contentItemContainer) return null;
		
		return $this->contentItemContainer->getNestedCiType();
	}

	public function isNested() {
		return null !== $this->contentItemContainer;
	}
	
	public function isFirstPanel() {
		return $this->getPanel() === self::NESTED_PANEL_NAME_1;
	}
	
	public function isSecondPanel() {
		return $this->getPanel() === self::NESTED_PANEL_NAME_2;
	}
	
	public function isThirdPanel() {
		return $this->getPanel() === self::NESTED_PANEL_NAME_3;
	}
	
	public function hasTwoColumns() {
		return $this->getNestedCiType() === self::NESTED_TWO_COLUMNS;
	}
	
	public function hasThreeColumns() {
		return $this->getNestedCiType() === self::NESTED_THREE_COLUMNS;
	}
	
	public function hasPrevContentItem() {
		return $this->contentItemContainer->hasPrevContentItem($this->getOrderIndex(),
				$this->getPanel());
	}
	
	public function getPrevContentItem() {
		return $this->contentItemContainer->getPrevContentItem($this->getOrderIndex(), 
				$this->getPanel());
	}
	
	public function hasNextContentItem() {
		return $this->contentItemContainer->hasNextContentItem($this->getOrderIndex(),
				$this->getPanel());
	}
	
	public function getNextContentItem() {
		return $this->contentItemContainer->getNextContentItem($this->getOrderIndex(), 
				$this->getPanel());
	}
}
