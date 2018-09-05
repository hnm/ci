<?php
namespace ci\bo\anchor;
use n2n\context\RequestScoped;
class AnchorState implements RequestScoped {
	
	private $anchors = array();
	
	public function getAnchors() {
		return $this->anchors;
	}
	
	public function addAnchor(string $id, string $title) {
		$baseId = $id;
		for ($i = 2; isset($this->anchors[$id]); $i++) {
			$id = $baseId . '-' . $i;
		}
		
		$this->anchors[$id] = new Anchor($id, $title);
		return $id;
	}
}

class Anchor {
	
	private $href;
	private $title;
	
	public function __construct($href, $title) {
		$this->href = $href;
		$this->title = $title;
	}

	public function getHref() {
		return $this->href;
	}

	public function setHref($href) {
		$this->href = $href;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

}