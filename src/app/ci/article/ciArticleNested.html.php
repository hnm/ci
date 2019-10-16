<?php
	use ci\article\CiArticle;
	use n2n\impl\web\ui\view\html\HtmlView;
	use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
	use bstmpl\ui\TemplateHtmlBuilder;
	use ch\hnm\util\page\bo\ExplPageLink;
	use bootstrap\img\MimgBs;
	use n2n\impl\web\ui\view\html\img\Mimg;
use ci\ui\CiUtils;
		
	/**
	 * @var HtmlView $view
	 */
	$view = HtmlView::view($view);
	$html = HtmlView::html($view);

	$article = $view->getParam('article');
	$view->assert($article instanceof CiArticle);
	
	$title = $article->getTitle();
	$fileImage = $article->getFileImage();
	
	$explLabel = null;
	$explUrl = null;
	$target = $article->determineTarget();
	$showExplicit = null;
	if (null !== ($explPageLink = $article->getExplPageLink())) {
	    $view->assert($explPageLink instanceof ExplPageLink);
	    $explUrl = $view->buildUrl($explPageLink, false, $explLabel);
	    $showExplicit = $explPageLink->isShowExplicit();
	}
	
	
	$isOpenLytebox = $article->isOpenLytebox();
	
	
	$imgComposer = MimgBs::xs(Mimg::crop(545, 409))->sm(510)->md(330)->lg(450)->xl(540);
	$tmplHtml = new TemplateHtmlBuilder($view);
	
	$ckeHtml = new CkeHtmlBuilder($view);
?>

<article class="ci-item-nested ci-article-nested<?php $html->out($title ? ' ci-article-nested--has-title' : '') ?> d-flex flex-column w-100">
	<figure class="ci-article-nested__image">	
		<?php if ($isOpenLytebox): ?>
			<?php $tmplHtml->fancyImage($fileImage, $imgComposer, null, array('class' => 'd-none d-sm-block'), 
					array('title' => $title, 'alt' => $article->determineAltTag())) ?>
		<?php endif ?>
		
		<?php $html->linkStart($explUrl, array('target' => $target), 'div') ?>
			
    	<?php if (null !== $fileImage): ?>
    		<?php $html->image($fileImage, $imgComposer, 
    				array('class' => 'img-fluid' . (true === $isOpenLytebox ? ' d-sm-none' : ''), 'title' => $title, 
    						'alt' => $article->determineAltTag())) ?>
    	<?php endif ?>

		<?php $html->linkEnd() ?>
	</figure>
		<?php if ($article->hasTitle()): ?>
			<h3 class="ci-article-nested__title">
				<?php if ($explUrl): ?>
					<?php $html->link($explUrl, $title, 
							array('target' => $target)) ?>
				<?php else: ?>
					<?php $html->out($title) ?>
				<?php endif ?>
			</h3>
		<?php endif ?>
		<?php $ckeHtml->out(CiUtils::getParsedHtml($article->getDescriptionHtml())) ?>
		<?php if ($explUrl && $showExplicit): ?>
			<?php $html->link($explUrl, '', array('class' => 'ci-article-nested__link','target' => $target)) ?>
			<?php $html->link($explUrl, $explLabel, array('class' => 'btn btn-md btn-primary mt-auto align-self-start', 'target' => $target)) ?>
		<?php endif ?>
</article>