<?php

namespace ci\ui;

use n2n\impl\web\ui\view\html\HtmlSnippet;
use n2n\impl\web\ui\view\html\HtmlView;
class CiHtmlBuilder {
	
	private $view;

	public function __construct(HtmlView $view) {
		$this->view = $view;
	}
	
	public function contentItems($contentItems, $panel) {
		if (empty($contentItems)) return null;
		foreach ($this->filter($contentItems, $panel) as $contentItem) {
			$this->view->out($contentItem->createUiComponent($this->view));
		}
	}
	
	private function filter($contentItems, $panel) {
		$panelContentItems = array();
		foreach ($contentItems as $contentItem) {
			if ($contentItem->getPanel() !== $panel) continue;
			array_push($panelContentItems, $contentItem);
		}
		return $panelContentItems;
	}
	
	public function getContentItems($contentItems, $panel) {
		if (empty($contentItems)) return null;
		
		$panelContentItems = $this->filter($contentItems, $panel);
		if (empty($panelContentItems)) return null;
		
		$htmlSnippet = new HtmlSnippet();
		foreach ($panelContentItems as $contentItem) {
			$htmlSnippet->appendLn($contentItem->createUiComponent($this->view));
		}
		return $htmlSnippet;
	}
	
	public function numContentItems($contentItems, $panel) {
		$this->view->out($this->getNumContentItems($contentItems, $panel));
	}
	
	public function getNumContentItems($contentItems, $panel) {
		if (empty($contentItems)) return 0;
		
		$panelContentItems = array();
		foreach ($contentItems as $contentItem) {
			if ($contentItem->getPanel() !== $panel) continue;
			array_push($panelContentItems, $contentItem);
		}
		return count($panelContentItems);
	}
	
	public function hasCiMultipleNestedCis($contentItems, array $panels) {
		if (empty($contentItems)) return false;
		$isMultiNested = false;
		foreach($panels as $panel) {
			$isCurrentPanelMultiNested = false;
			$counter = 0;
			foreach ($contentItems as $contentItem) {
				if ($contentItem->getPanel() !== $panel) continue;
				$counter++;
				if ($counter > 1) {
					$isCurrentPanelMultiNested = true;
					break;
				}
			}
			
			if ($isCurrentPanelMultiNested === true) {
				$isMultiNested = true;
				break;
			}
		}
		
		return $isMultiNested;
	}
}