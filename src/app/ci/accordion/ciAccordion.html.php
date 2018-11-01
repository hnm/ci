<?php
    use n2n\impl\web\ui\view\html\HtmlView;
    use ci\accordion\CiAccordion;
    use ci\ui\CiHtmlBuilder;

    /**
    * @var HtmlView $view
    */
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$ciAccordion = $view->getParam('ciAccordion');
	$view->assert($ciAccordion instanceof CiAccordion);
	
	$ciHtml = new CiHtmlBuilder($view);
	
	$html->meta()->bodyEnd()->addJs('js/functions.js');
?>

<div class="ci-accordion">
	<div class="ci-accordion-title">
		<?php $html->out($ciAccordion->getTitle()) ?>
	</div>
	<div class="ci-accordion-content">
		<?php $ciHtml->contentItems($ciAccordion->getContentItems(), 'main') ?>
	</div>
</div>
