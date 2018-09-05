<?php
namespace ci\bo\columns;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoMappedSuperclass;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use rocket\impl\ei\component\prop\ci\model\ContentItem;

abstract class NestedContentItem extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->c(new AnnoMappedSuperclass());
	}
	
	const NESTED_TWO_COLUMNS = 'nested-two-columns';
	const NESTED_THREE_COLUMNS = 'nested-three-columns';
	
	const NESTED_PANEL_NAME_1 = 'column-1';
	const NESTED_PANEL_NAME_2 = 'column-2';
	const NESTED_PANEL_NAME_3 = 'column-3';
	
	
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
	
	public abstract function getNestedCiType();
	
	public abstract function setNestedCiType($nestedCiType);
	
	public function isNested() {
		return null !== $this->getNestedCiType();
	}
}