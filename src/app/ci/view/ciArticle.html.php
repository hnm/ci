<?php
	use ci\bo\CiArticle;
	use n2n\impl\web\ui\view\html\HtmlView;
	use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
	use n2nutil\bootstrap\img\MimgBs;
	use n2n\impl\web\ui\view\html\img\Mimg;
	use bstmpl\ui\TemplateHtmlBuilder;
	use ch\hnm\util\page\bo\ExplPageLink;
	
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
	$altTag = $article->determineAltTag();
	$target = $article->determineTarget();
	$rel = $article->determineRel();
	$showExplicit = null;
	if (null !== ($explPageLink = $article->getExplPageLink())) {
	    $view->assert($explPageLink instanceof ExplPageLink);
	    $explUrl = $view->buildUrl($explPageLink, false, $explLabel);
	    $showExplicit = $explPageLink->isShowExplicit();
	}
	
	
	$isOpenLytebox = $article->isOpenLytebox();
	
	$classImage = $article->getPicPos() == CiArticle::PIC_POS_LEFT ? '' : ' order-sm-1';
	
	$imgComposer = MimgBs::xs(Mimg::prop(545, 409))->sm(150)->md(210)->lg(290)->xl(350);
	$tmplHtml = new TemplateHtmlBuilder($view);
	
	$ckeHtml = new CkeHtmlBuilder($view);
?>

<article class="row ci-article<?php $html->out($title ? ' has-title' : '') ?>">
	<div class="col-sm-4<?php $html->out($classImage) ?>">
		<figure class="ci-article-image">
			<?php if ($isOpenLytebox): ?>
				<?php $tmplHtml->fancyImage($fileImage, $imgComposer, null, array('class' => 'd-none d-sm-block'), 
						array('title' => $title, 'alt' => $altTag)) ?>
			<?php endif ?>
			
			<?php $html->linkStart($explUrl, array('target' => $target, 'rel' => $rel), 'div') ?>
			
    			<?php if (null !== $fileImage): ?>
    				<?php $html->image($fileImage, $imgComposer, 
    						array('class' => 'img-fluid' . (true === $isOpenLytebox ? ' d-sm-none' : ''), 'title' => $title, 
    								'alt' => $altTag)) ?>
    			<?php endif ?>

			<?php $html->linkEnd() ?>
		</figure>
	</div>
	<div class="col-sm-8 ci-article-text">
		<?php if ($article->hasTitle()): ?>
			<h2 class="ci-article-title">
				<?php if ($explUrl): ?>
					<?php $html->link($explUrl, $title, 
							array('target' => $target, 'rel' => $rel)) ?>
				<?php else: ?>
					<?php $html->out($title) ?>
				<?php endif ?>
			</h2>
		<?php endif ?>
		<?php $ckeHtml->out($article->getDescriptionHtml()) ?>
		<?php if ($explUrl && $showExplicit): ?>
			<?php $html->link($explUrl, $explLabel, array('class' => 'btn btn-primary', 'target' => $target, 'rel' => $rel)) ?>
		<?php endif ?>
	</div>
</article>