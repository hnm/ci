<?php
namespace ci\bo;
use n2n\context\RequestScoped;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class CiState implements RequestScoped {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
	}
	const CI_ARTICLE = 'ci-article';
	const CI_ATTACHMENT = 'ci-attachment';
	const CI_ATTACHMENT_SPLITTED = 'ci-attachment-splitted';
	const CI_CKE = 'ci-cke';
	const CI_CKE_SPLITTED = 'ci-cke-splitted';
	const CI_HTML_SNIPPET = 'ci-html-snippet';
	const CI_YOUTUBE = 'ci-youtube';
	
	const VARIATION_LIMIT = 3;
	
	private $ciCounts = array();
	
	public function getOrderNumber($contentItemKey) {
		
		switch ($contentItemKey) {
			case self::CI_ATTACHMENT_SPLITTED:
				$this->determineOrderNumber($contentItemKey);
				break;
			case self::CI_CKE_SPLITTED:
				$this->determineOrderNumber($contentItemKey);
				break;
			case self::CI_ATTACHMENT:
					$this->determineOrderNumber($contentItemKey, 2);
				
					break;
			default:
				throw new \InvalidArgumentException();
		}
		return $this->ciCounts[$contentItemKey];
	}
	

	private function determineOrderNumber($key, $limit = null) {
		$variationLimit = $limit ? $limit : self::VARIATION_LIMIT;
		
		if (!array_key_exists($key, $this->ciCounts)) {
			$this->ciCounts[$key] = 1;
		} else {
			if (($this->ciCounts[$key] % $variationLimit) === 0) {
				$this->ciCounts[$key] = 1;
			} else {
				$this->ciCounts[$key]++;
			}
		}
	}
	
}