<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2n\impl\web\ui\view\html\HtmlElement;
	use bstmpl\ui\TemplateHtmlBuilder;
	use n2n\impl\web\ui\view\html\HtmlUtils;
	use ch\hnm\util\page\bo\ExplPageLink;
	use ci\image\CiImage;

	/**
	 * @var \n2n\web\ui\view\View $view
	 */
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$image = $view->getParam('image');
	$view->assert($image instanceof CiImage);
	
	$nestedType = $image->getNestedCiType();
	
	$tmplHtml = new TemplateHtmlBuilder($view);
	
	
	$panel = $image->getPanel();
	$alignment = $image->getAlignment();

	$fileImage = $image->getFileImage();
	
	$explLabel = null;
	$explUrl = null;
	$target = $image->determineTarget();
	$explPageLink = $image->getExplPageLink();
	if (null !== $explPageLink) {
		$view->assert($explPageLink instanceof ExplPageLink);
		$explUrl = $explPageLink->isShowExplicit() ? $view->buildUrl($explPageLink, false, $explLabel) : null;
	}
	
	$isOpenLytebox = $image->isOpenLytebox();

	$imgComposer = $image->getImgComposer();
	
	$containerAttrs = $image->getContainerAttrs();
	
	if ($alignment) {
		$containerAttrs = HtmlUtils::mergeAttrs($containerAttrs, array('class' => 'clearfix'));
	}
?>
<figure <?php $view->out(HtmlElement::buildAttrsHtml($containerAttrs)) ?>>
	<?php if ($isOpenLytebox): ?>
		<?php $tmplHtml->fancyImage($fileImage, $imgComposer, null, array('class' => 'd-none d-md-block'), array('alt' => $image->determineAltTag())) ?>
	<?php endif ?>
	
	<?php $html->linkStart($explPageLink, array('target' => $target), 'div') ?>
		<?php if (null !== $fileImage): ?>
			<?php $html->image($fileImage, $imgComposer, array(
					'class' => 'img-fluid' . (true === $isOpenLytebox ? ' d-md-none' : ''), 
					'alt' => $image->determineAltTag())) ?>
		<?php endif ?>
	<?php $html->linkEnd() ?>
		
	<?php if (null !== ($caption = $image->getCaption())): ?>
		<figcaption><?php $html->out($caption) ?></figcaption>
	<?php endif ?>
	<?php if (null !== $explPageLink && $explPageLink->isShowExplicit()): ?>
		<?php $html->link($explUrl, null, array('target' => $target)) ?>
	<?php endif ?>
</figure>
