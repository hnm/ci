<?php
    use n2n\impl\web\ui\view\html\HtmlView;
    use ci\accordion\CiAccordion;
    use ci\ui\CiHtmlBuilder;
	use bstmpl\model\BsTemplateModel;

    /**
    * @var HtmlView $view
    */
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$ciAccordion = $view->getParam('ciAccordion');
	$view->assert($ciAccordion instanceof CiAccordion);
	
	$ciHtml = new CiHtmlBuilder($view);
	
	$html->meta()->bodyEnd()->addJs('js/functions.js?v=' . BsTemplateModel::ASSETS_VERSION);
?>

<div class="ci-item ci-accordion">
	<h2 class="ci-accordion__title"><?php $html->out($ciAccordion->getTitle()) ?></h2>
	<div class="ci-accordion__body">
		<?php $ciHtml->contentItems($ciAccordion->getContentItems(), 'ci-accordion-panel-main') ?>
	</div>
</div>
