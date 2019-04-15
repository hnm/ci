<?php
namespace ci\ui;
class CiUtils {
	
	public static function getParsedHtml($contentHtml) {
		$dom = new \DOMDocument();
		@$dom->loadHTML($contentHtml);
		
		//ul style
		$uls = $dom->getElementsByTagName('ul');
		foreach ($uls as $ul) {
			$ul instanceof \DOMElement;
			if ($ul->hasAttribute('class')) {
				$ul->setAttribute('class', $ul->getAttribute('class') . ' hnm-list');
			} else {
				$ul->setAttribute('class', 'hnm-list');
			}
		}
		
		//blockquote style
		$blockquotes = $dom->getElementsByTagName('blockquote');
		foreach ($blockquotes as $blockquote) {
			$blockquote instanceof \DOMElement;
			if ($blockquote->hasAttribute('class')) {
				$blockquote->setAttribute('class', $blockquote->getAttribute('class') . ' fdt-blockquote');
			} else {
				$blockquote->setAttribute('class', 'fdt-blockquote');
			}
		}
		
		return  preg_replace("/(<\/?html>|<!DOCTYPE.+|<\/?body>)/", '', $dom->saveHTML());
		
		// 		$dom->removeChild($dom->doctype);
		
		// 		return str_replace('</body></html>', '', str_replace('<html><body>', '', $dom->saveHTML()));
	}
}

