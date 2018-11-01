<?php
	use ci\columns\CiTwoColumns;
	use n2n\impl\web\ui\view\html\HtmlView;
	use ci\ui\CiHtmlBuilder;
	use ci\columns\NestedContentItem;
	
	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$ciHtml = new CiHtmlBuilder($view);
	
	$ciTwoColumns = $view->getParam('ciTwoColumns');
	$view->assert($ciTwoColumns instanceof CiTwoColumns);
	
	$contentItems = $ciTwoColumns->getContentItems();
	if (empty($contentItems)) return null;
	
	$isMultiNested = $ciHtml->hasCiMultipleNestedCis($contentItems, $ciTwoColumns->getPanels());
?>
<div class="row ci-2-col<?php $html->out($isMultiNested ? ' ci-has-multi': '') ?>">
	<div class="col-md-6<?php $html->out($isMultiNested ? '' : ' d-flex') ?> ci-2-col-left">
		<?php $ciHtml->contentItems($contentItems, NestedContentItem::NESTED_PANEL_NAME_1) ?>
	</div>
	<div class="col-md-6<?php $html->out($isMultiNested ? '' : ' d-flex') ?> ci-2-col-right">
		<?php $ciHtml->contentItems($contentItems, NestedContentItem::NESTED_PANEL_NAME_2) ?>
	</div>
</div>