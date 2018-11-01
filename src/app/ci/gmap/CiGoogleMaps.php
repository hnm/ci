<?php
namespace ci\gmap;

use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;

class CiGoogleMaps extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
	}

	private $lat;
	private $lng;
	private $title;
	private $description;
	private $zoom;
	private $showInfoWindow;

	public function getLat() {
		return $this->lat;
	}

	public function setLat($lat) {
		$this->lat = $lat;
	}

	public function getLng() {
		return $this->lng;
	}

	public function setLng($lng) {
		$this->lng = $lng;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function getZoom() {
		return $this->zoom;
	}
	
	public function setZoom($zoom = null) {
		$this->zoom = $zoom;
	}

	/**
	 * @return bool
	 */
	public function isShowInfoWindow() {
		return (bool) $this->showInfoWindow;
	}

	/**
	 * @param bool $showInfoWindow
	 */
	public function setShowInfoWindow(bool $showInfoWindow) {
		$this->showInfoWindow = (bool) $showInfoWindow;
	}

	public function getLocations() {
		$markers = array();
		$markers[] = array(
				'lat' => $this->lat,
				'lng' => $this->lng,
				// 				'address' => 'Hofmänner New Media, Stadthausstrasse 65, 8400 Winterthur',
				'title' => $this->title,
				// 				'icon' => array(
				// 						'url' => $this->getContextAssetsUrl('hnm-marker.svg'),
				// 						'sizeScaled' => array(
				// 								'width' => 80,
				// 								'height' => 97
				// 						)
				// 				),
				'info' => array(
						'title' => $this->title,
						'description' =>  $this->description,
						'forceOpen' => $this->showInfoWindow
				)
		);
		
		return $markers;
	}
	
	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\ci\gmap\ciGoogleMaps.html', array('ciGoogleMaps' => $this));
	}
}