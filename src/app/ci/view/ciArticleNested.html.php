<?php
	use ci\bo\CiArticle;
	use n2n\impl\web\ui\view\html\HtmlView;
	use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
	use bstmpl\ui\TemplateHtmlBuilder;
	use ch\hnm\util\page\bo\ExplPageLink;
	use n2nutil\bootstrap\img\MimgBs;
	use n2n\impl\web\ui\view\html\img\Mimg;
		
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
	$rel = $article->determineRel();
	$showExplicit = null;
	if (null !== ($explPageLink = $article->getExplPageLink())) {
	    $view->assert($explPageLink instanceof ExplPageLink);
	    $explUrl = $view->buildUrl($explPageLink, false, $explLabel);
	    $showExplicit = $explPageLink->isShowExplicit();
	}
	
	
	$isOpenLytebox = $article->isOpenLytebox();
	
	
	$classArticleTextHolder = 'ci-article-nested-text link-no-deco';
	
	$imgComposer = MimgBs::xs(Mimg::crop(545, 409))->sm(510)->md(330)->lg(450)->xl(540);
	$tmplHtml = new TemplateHtmlBuilder($view);
	
	$ckeHtml = new CkeHtmlBuilder($view);
	
?>

<article class="ci-article-nested<?php $html->out($title ? ' has-title' : '') ?> d-flex flex-column w-100">
	<figure class="ci-article-image">
		<?php if ($isOpenLytebox): ?>
			<?php $tmplHtml->fancyImage($fileImage, $imgComposer, null, array('class' => 'd-none d-sm-block'), 
					array('title' => $title, 'alt' => $article->determineAltTag())) ?>
		<?php endif ?>
		
		<?php $html->linkStart($explUrl, array('target' => $target, 'rel' => $rel), 'div') ?>
			
    	<?php if (null !== $fileImage): ?>
    		<?php $html->image($fileImage, $imgComposer, 
    				array('class' => 'img-fluid' . (true === $isOpenLytebox ? ' d-sm-none' : ''), 'title' => $title, 
    						'alt' => $article->determineAltTag())) ?>
    	<?php endif ?>

		<?php $html->linkEnd() ?>
	</figure>
		<?php if ($article->hasTitle()): ?>
			<h3>
				<?php $html->out($title) ?>
			</h3>
		<?php endif ?>
		<?php $ckeHtml->out($article->getDescriptionHtml()) ?>
		<?php if ($explUrl && $showExplicit): ?>
			<?php $html->link($explUrl, '', array('class' => 'ci-article-nested-link','target' => $target, 'rel' => $rel)) ?>
			<?php $html->link($explUrl, $explLabel, array('class' => 'btn btn-md btn-default mt-auto align-self-start align-self-sm-stretch', 'target' => $target, 'rel' => $rel)) ?>
		<?php endif ?>
</article>