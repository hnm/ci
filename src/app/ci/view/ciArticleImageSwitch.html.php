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
	$target = $article->determineTarget();
	
	$explLabel = null;
	$explUrl = null;
	$explPageLink = $article->getExplPageLink();
	$target = null;
	$showExplicit = null;
	if (null !== $explPageLink) {
		$view->assert($explPageLink instanceof ExplPageLink);
		$explUrl = $view->buildUrl($explPageLink, false, $explLabel) ?: null;
		$target = $explPageLink->getType() == ExplPageLink::TYPE_EXTERNAL ? '_blank' : null;
		$showExplicit = $explPageLink->isShowExplicit();
	}
	
	$classImage = $article->getPicPos() == CiArticle::PIC_POS_LEFT ? '' : ' push-sm-8';
	$classText = $article->getPicPos() == CiArticle::PIC_POS_LEFT ? '' : ' pull-sm-4';
	
	$imgComposer = MimgBs::xs(Mimg::prop(497, 332))->sm(546)->md(690)->lg(910)->xl(1110);
	$tmplHtml = new TemplateHtmlBuilder($view);
	
	$ckeHtml = new CkeHtmlBuilder($view);
?>

<article class="row ci-article<?php $html->out($title ? ' has-title' : '') ?>">
	<div class="col-sm-4<?php $html->out($classImage) ?>">
		<figure class="ci-image">
			<?php if ($article->isOpenLytebox()): ?>
				<?php $tmplHtml->fancyImage($fileImage, $imgComposer, null, null, array('class' => 'd-none d-sm-block', 'title' => $title)) ?>
			<?php else: ?>
				<?php if ($explUrl): ?>
					<?php $html->linkStart($explUrl, array('target' => $target)) ?>
				<?php endif ?>
				<?php if (null !== $fileImage): ?>
					<div class="d-none d-sm-block">
						<?php $html->image($fileImage, $imgComposer, array('class' => 'img-fluid', 'title' => $title)) ?>
					</div>
				<?php endif ?>
				<?php if ($explUrl): ?>
					<?php $html->linkEnd() ?>
				<?php endif ?>
			<?php endif ?>
		</figure>
	</div>
	<div class="col-sm-8<?php $html->out($classText) ?> ci-article-text">
		<?php if ($article->hasTitle()): ?>
			<h2>
				<?php $html->out($title) ?>
			</h2>
		<?php endif ?>
		<?php if ($explUrl): ?>
			<?php $html->linkStart($explUrl, array('target' => $target)) ?>
		<?php endif ?>
		<?php if (null !== $fileImage): ?>
			<div class="d-sm-none">
				<?php $html->image($fileImage, $imgComposer, array('class' => 'img-fluid', 'title' => $title)) ?>
			</div>
		<?php endif ?>
		<?php if ($explUrl): ?>
			<?php $html->linkEnd() ?>
		<?php endif ?>
		<?php $ckeHtml->out($article->getDescriptionHtml()) ?>
		<?php if ($explUrl && $showExplicit): ?>
			<?php $html->link($explUrl, $explLabel, array('class' => 'ci-article-link', 'target' => $target)) ?>
		<?php endif ?>
	</div>
</article>