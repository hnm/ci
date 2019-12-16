<?php
namespace ci\ui;
class CiUtils {
	
	public static function getParsedHtml($contentHtml) {
		$dom = new \DOMDocument();
		@$dom->loadHTML('<?xml encoding="utf-8">' . $contentHtml);
		
		//ul style
		$uls = $dom->getElementsByTagName('ul');
		foreach ($uls as $ul) {
			$ul instanceof \DOMElement;
			if ($ul->hasAttribute('class')) {
				$ul->setAttribute('class', $ul->getAttribute('class') . ' bstmpl-list');
			} else {
				$ul->setAttribute('class', 'bstmpl-list');
			}
		}
		
		//blockquote style
		$blockquotes = $dom->getElementsByTagName('blockquote');
		foreach ($blockquotes as $blockquote) {
			$blockquote instanceof \DOMElement;
			if ($blockquote->hasAttribute('class')) {
				$blockquote->setAttribute('class', $blockquote->getAttribute('class') . ' bstmpl-blockquote');
			} else {
				$blockquote->setAttribute('class', 'bstmpl-blockquote');
			}
		}
		
		
		return preg_replace("/(<\/?html>|<\?xml encoding=\"utf-8\">|<\/xml>|<!DOCTYPE.+|<\/?body>)/", '',
				$dom->saveHTML());
		
		// 		$dom->removeChild($dom->doctype);
		
		// 		return str_replace('</body></html>', '', str_replace('<html><body>', '', $dom->saveHTML()));
	}
}

