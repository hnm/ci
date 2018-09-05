<?php
namespace ci\bo;

use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\impl\web\ui\view\html\HtmlView;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;
use n2n\persistence\orm\annotation\AnnoOrderBy;

class CiAccordion extends ContentItem {
    
    private static function _annos(AnnoInit $ai) {
        $ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
        $ai->p('contentItems', new AnnoOneToMany(ContentItem::getClass(), null, CascadeType::ALL, null, true),
            new AnnoOrderBy(array('orderIndex' => 'ASC')));
    }
    
    private $title;
    /**
     * @var ContentItem[]
     */
    private $contentItems = array();
        
    
    /**
     * @return the $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param field_type $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return the $contentItems
     */
    public function getContentItems()
    {
        return $this->contentItems;
    }

    /**
     * @param multitype:\rocket\impl\ei\component\prop\ci\bo\ContentItem  $contentItems
     */
    public function setContentItems($contentItems)
    {
        $this->contentItems = $contentItems;
    }

    public function createUiComponent(HtmlView $view) {
        return $view->getImport('\ci\view\ciAccordion.html', array('ciAccordion' => $this));
    }
}
