<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use ci\anchor\AnchorState;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	$anchorState = $view->lookup(AnchorState::class);
	$view->assert($anchorState instanceof AnchorState);
?>

<?php //Add another anchor manually somewhere like that: ?>
<div id="<?php $html->out($anchorState->addAnchor('example-acnhor-id', 'example-label')) ?>" class="ci-anchor"></div>

<?php //print the anchors - be sure all anchors get added before that call: ?>
<?php if (null !== ($anchors = $anchorState->getAnchors()) && !empty($anchorState->getAnchors())): ?>
	<ul class="list-inline ci-anchors d-none d-md-inline">
		<?php foreach($anchors as $anchor): ?>
			<li class="list-inline-item">
				<a href="#<?php $html->out($anchor->getHref()) ?>" class="btn btn-primary"><?php $html->out($anchor->getTitle()) ?></a>
			</li>
		<?php endforeach ?>
	</ul>
<?php endif ?>