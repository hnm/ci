<?php 
	use n2n\impl\web\ui\view\html\HtmlView;
	use n2n\impl\web\ui\view\html\HtmlUtils;
	use ci\attachment\CiAttachment;

	$view = HtmlView::view($view);
	$html = HtmlView::html($view);

	$ciAttachment = $view->getParam('ciAttachment');
	$view->assert($ciAttachment instanceof CiAttachment);
	
	$file = $ciAttachment->getFile();
	
	$aAttr = array('target' => '_blank', 'class' => 'ci-attachment file', 'download' => '');
	
	$aAttr = HtmlUtils::mergeAttrs($aAttr, array('class' => $ciAttachment->isNested() ? 'ci-item-nested' : 'ci-item'));
	if (null !== $file && $file->isValid()) {
		$aAttr = HtmlUtils::mergeAttrs($aAttr, array('class' => $file->getOriginalExtension()));
	}
?>

<?php $html->linkStart($file, $aAttr, 'div') ?>
	<h3 class="ci-attachment__title h2"><?php $html->out($ciAttachment->getLabel()) ?></h3>
	<?php if (null !== ($desc = $ciAttachment->getDescription())): ?>
		<p class="ci-attachment__description"><?php $html->out($desc)?></p>
	<?php endif ?>
<?php $html->linkEnd() ?>