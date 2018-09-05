<?php
use n2n\impl\web\ui\view\html\HtmlView;
use ci\bo\CiYoutube;

	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	$youtube = $view->getParam('youtube');
	$view->assert($youtube instanceof CiYoutube);
	$youtubeId = $youtube->getyoutubeId();
	$html->meta()->bodyEnd()->addJs('js/youtube.js', 'ci');
	
?>
<div class="embed-responsive embed-responsive-16by9 ci-video <?php $html->out(null !== $youtube->getNestedCiType() ? ' align-self-start' : '') ?>" data-video-id="<?php $html->out($youtubeId) ?>" 
		data-width="940" data-height="529">
</div>