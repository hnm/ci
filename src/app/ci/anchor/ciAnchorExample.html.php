<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use ci\anchor\AnchorState;
	use ci\anchor\Anchor;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	$anchorState = $view->lookup(AnchorState::class);
	$view->assert($anchorState instanceof AnchorState);
?>

<?php //Add another anchor manually somewhere like that: ?>
<div id="<?php $html->out($anchorState->addAnchor('example-anchor-id', 'example-label')) ?>" class="ci-anchor-target"></div>

<?php //print the anchors - be sure all anchors get added before that call: ?>
<?php if (null !== ($anchors = $anchorState->getAnchors()) && !empty($anchorState->getAnchors())): ?>
	<ul class="ci-item ci-anchors list-inline d-none d-md-inline">
		<?php foreach($anchors as $anchor): $view->assert($anchor instanceof Anchor) ?>
			<li class="ci-anchor">
				<a href="#<?php $html->out($anchor->getHref()) ?>" class="btn btn-primary"><?php $html->out($anchor->getTitle()) ?></a>
			</li>
		<?php endforeach ?>
	</ul>
<?php endif ?>