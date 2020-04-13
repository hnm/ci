<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use ci\video\CiYoutube;
use n2n\impl\web\ui\view\html\HtmlUtils;
use n2n\impl\web\ui\view\html\HtmlElement;
	use bstmpl\model\BsTemplateModel;

	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	$ciYoutube = $view->getParam('ciYoutube');
	$view->assert($ciYoutube instanceof CiYoutube);
	$html->meta()->bodyEnd()->addJs('js/youtube.js?v=' . BsTemplateModel::ASSETS_VERSION, 'ci');
	
	$attrs = ['class' => 'embed-responsive embed-responsive-16by9 ci-video', 'data-video-id' => $ciYoutube->getYoutubeId(), 'data-width' => '940', 'data-height' => '529'];
	$attrs = HtmlUtils::mergeAttrs($attrs, ['class' => $ciYoutube->isNested() ? 'ci-item-nested' : 'ci-item']);
	if (null !== $ciYoutube->getNestedCiType()) {
		$attrs = HtmlUtils::mergeAttrs($attrs, ['class' => 'align-self-start']);
	}
	
?>
<div <?php $view->out(HtmlElement::buildAttrsHtml($attrs)) ?>>
</div>