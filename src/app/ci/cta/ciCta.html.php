<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use ci\cta\CiCta;
use bstmpl\ui\TemplateHtmlBuilder;

	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	$ciCta =  $view->getParam('ciCta');
	$view->assert($ciCta instanceof CiCta);
	
	$tmplHtml = new TemplateHtmlBuilder($view);
?>

<div class="ci-item ci-cta">
	<?php if (null !== ($title = $ciCta->getTitle())): ?>
		<h2 class="display-2 ci-cta__title"><?php $html->out($title) ?></h2>
	<?php endif ?>
	<?php if (null !== ($intro = $ciCta->getIntro())): ?>
		<p><?php $html->out($intro) ?></p>
	<?php endif ?>
	<?php if ($ciCta->hasContactItems()): ?>
		<div class="ci-cta-links">
			<?php if (null !== ($phone = $ciCta->getPhone())): ?>
				<?php $tmplHtml->linkTelProper($phone, null, ['class' => 'btn btn-outline-white']) ?>
			<?php endif ?>
			<?php if (null !== ($email = $ciCta->getEmail())): ?>
				<?php $html->linkEmail($email, null, ['class' => 'btn btn-outline-white']) ?>
			<?php endif ?>
			<?php if (null !== ($link = $ciCta->getLink())): ?>
				<?php $html->link($link, null, ['class' => 'btn btn-outline-white']) ?>
			<?php endif ?>
		</div>
	<?php endif ?>
</div>