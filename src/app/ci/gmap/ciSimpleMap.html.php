<?php
	use ci\gmap\CiSimpleMap;
use n2n\impl\web\ui\view\html\HtmlView;

	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	$ciSimpleMap =  $view->getParam('ciSimpleMap');
	$view->assert($ciSimpleMap instanceof CiSimpleMap);
?>
