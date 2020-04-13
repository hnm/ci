<?php
	use ci\columns\CiTwoColumns;
	use ci\ui\CiHtmlBuilder;
	use ci\columns\NestedContentItem;
	use n2n\impl\web\ui\view\html\HtmlView;
	
	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$ciHtml = new CiHtmlBuilder($view);
	
	$ciTwoColumns = $view->getParam('ciTwoColumns');
	$view->assert($ciTwoColumns instanceof CiTwoColumns);
	
	$contentItems = $ciTwoColumns->getContentItems();
	if (empty($contentItems)) return null;
	
	$isMultiNested = $ciHtml->hasCiMultipleNestedCis($contentItems, $ciTwoColumns->getPanels());
?>
<div class="row ci-col ci-2-col<?php $html->out($isMultiNested ? ' ci-has-multi': '') ?> <?php $html->out($ciTwoColumns->getAlignmentClass()) ?>">
	<div class="<?php $html->out($ciTwoColumns->getClassForPanel(NestedContentItem::NESTED_PANEL_NAME_1)) ?><?php $html->out($isMultiNested ? '' : ' d-flex flex-column') ?> ci-2-col-left">
		<?php $ciHtml->contentItems($contentItems, NestedContentItem::NESTED_PANEL_NAME_1) ?>
	</div>
	<div class="<?php $html->out($ciTwoColumns->getClassForPanel(NestedContentItem::NESTED_PANEL_NAME_2)) ?><?php $html->out($isMultiNested ? '' : ' d-flex flex-column') ?> ci-2-col-right">
		<?php $ciHtml->contentItems($contentItems, NestedContentItem::NESTED_PANEL_NAME_2) ?>
	</div>
</div>