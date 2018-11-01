<?php
	use n2n\impl\web\ui\view\html\HtmlView;
	use ci\gmap\CiSimpleMap;

	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	$ciSimpleMap =  $view->getParam('ciSimpleMap');
	$view->assert($ciSimpleMap instanceof CiSimpleMap);
?>
