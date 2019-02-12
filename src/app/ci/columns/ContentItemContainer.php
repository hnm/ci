<?php
namespace ci\columns;

use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoMappedSuperclass;
use rocket\impl\ei\component\prop\ci\model\ContentItem;

abstract class ContentItemContainer extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoMappedSuperclass());
	}
	/**
	 * @return ContentItem []
	 */
	public abstract function getContentItems();
	
	/**
	 * @return string
	 */
	public abstract function getNestedCiType();
	
	/**
	 * @param int $orderIndex
	 * @param string $panel
	 * @return ContentItem|null;
	 */
	public function getPrevContentItem(int $orderIndex, string $panel = null) {
		$tContentItem = null;
		foreach ($this->getContentItems() as $contentItem) {
			if ($contentItem->getOrderIndex() >= $orderIndex) continue;
			if (null !== $panel && $contentItem->getPanel() !== $panel) continue;
			if (null !== $tContentItem && $tContentItem->getOrderIndex() <= $contentItem->getOrderIndex()) continue;
			
			$tContentItem = $contentItem;
		}
		
		return $tContentItem;
	}
	
	
	public function hasPrevContentItem(int $orderIndex, string $panel = null) {
		return null !== $this->getNextContentItem($orderIndex, $panel);
	}
	
	/**
	 * @param int $orderIndex
	 * @param string $panel
	 * @return ContentItem|null;
	 */
	public function getNextContentItem(int $orderIndex, string $panel = null) {
		$tContentItem = null;
		foreach ($this->getContentItems() as $contentItem) {
			if ($contentItem->getOrderIndex() <= $orderIndex) continue;
			if (null !== $panel && $contentItem->getPanel() !== $panel) continue;
			if (null !== $tContentItem && $tContentItem->getOrderIndex() >= $contentItem->getOrderIndex()) continue;
			
			$tContentItem = $contentItem;
		}
		
		return $tContentItem;
	}
	
	public function hasNextContentItem(int $orderIndex, string $panel = null) {
		return null !== $this->getNextContentItem($orderIndex, $panel);
	}
}