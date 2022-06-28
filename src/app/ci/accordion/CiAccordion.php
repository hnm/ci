<?php
namespace ci\accordion;

use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use n2n\persistence\orm\annotation\AnnoOrderBy;
use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\persistence\orm\annotation\AnnoManyToOne;

class CiAccordion extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('accordions', new AnnoOneToMany(Accordion::getClass(), null, \n2n\persistence\orm\CascadeType::ALL, null, true));
	}

	private $title;
	private $accordions;

	/**
     * @return string
     */
	public function getTitle() {

        return $this->title;
	}

	/**
     * @param string $title
     */
	public function setTitle(string $title = null) {

        $this->title = $title;
	}

	public function createUiComponent(HtmlView $view) {

        return $view->getImport('\ci\accordion\ciAccordion.html', array('ciAccordion' => $this));
	}

	/**
	 * @return Accordion[]
	 */
	public function getAccordions() {
		return $this->accordions;
	}

	public function setAccordions($accordions) {
		$this->accordions = $accordions;
	}
}