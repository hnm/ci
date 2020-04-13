<?php 
	use ci\gmap\CiGoogleMaps;
	use n2n\util\StringUtils;
	use n2n\impl\web\ui\view\html\HtmlView;
	use bstmpl\model\BsTemplateModel;
	
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);
	
	$ciGoogleMaps = $view->getParam('ciGoogleMaps');
	$view->assert($ciGoogleMaps instanceof CiGoogleMaps);
	
	$meta = $html->meta();
	
	$gmapsData = ['v' => '3', 'key' => test('no Google Maps api-key defined')];
	
	
	$meta->bodyEnd()->addJsUrl('https://maps.googleapis.com/maps/api/js?' . http_build_query($gmapsData));
	$meta->bodyEnd()->addJs('js/gmaps.js?v=' . BsTemplateModel::ASSETS_VERSION, 'bstmpl');
	
?>
<div class="tmpl-map ci-item ci-gmaps" 
		data-lat=<?php $html->out($ciGoogleMaps->getLat()) ?> 
		data-lng=<?php $html->out($ciGoogleMaps->getLng()) ?> 
		data-locations="<?php $html->out(StringUtils::jsonEncode($ciGoogleMaps->getLocations())) ?>" 
	<?php $view->out(null !== ($zoom = $ciGoogleMaps->getZoom()) ? 'data-zoom="' . $html->getEsc($zoom) . '"' : '') ?>
	<?php $view->out(null !== ($showInfoWindow = $ciGoogleMaps->isShowInfoWindow()) ? 'data-show-info-window="' . $html->getEsc($showInfoWindow) . '"' : '') ?>>
</div>