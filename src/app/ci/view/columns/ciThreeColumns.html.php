<?php
	use ci\bo\columns\CiThreeColumns;
	use n2n\impl\web\ui\view\html\HtmlView;
	use ci\ui\CiHtmlBuilder;
use ci\bo\columns\NestedContentItem;
	
	$view = HtmlView::view($this);
	$html = HtmlView::html($view);
	
	$ciHtml = new CiHtmlBuilder($view);
	
	$ciThreeColumns = $view->getParam('ciThreeColumns');
	$view->assert($ciThreeColumns instanceof CiThreeColumns);
	$contentItems = $ciThreeColumns->getContentItems();
	if (empty($contentItems)) return null;
	
	$isMultiNested = $ciHtml->hasCiMultipleNestedCis($contentItems, $ciThreeColumns->getPanels());
?>
<div class="row ci-3-col<?php $html->out($isMultiNested ? ' ci-has-multi': '') ?>">
	<div class="col-md-4<?php $html->out($isMultiNested ? '' : ' d-flex') ?> ci-3-col-left">
		<?php $ciHtml->contentItems($contentItems, NestedContentItem::NESTED_PANEL_NAME_1) ?>
	</div>
	<div class="col-md-4<?php $html->out($isMultiNested ? '' : ' d-flex') ?> ci-3-col-middle">
		<?php $ciHtml->contentItems($contentItems, NestedContentItem::NESTED_PANEL_NAME_2) ?>
	</div>
	<div class="col-md-4<?php $html->out($isMultiNested ? '' : ' d-flex') ?> ci-3-col-right">
		<?php $ciHtml->contentItems($contentItems, NestedContentItem::NESTED_PANEL_NAME_3) ?>
	</div>
</div>