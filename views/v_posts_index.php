<div id='article_container'>
<?php if ($posts==null) {
		echo "There are no posts to display.";
	} ?>
<?php foreach($posts as $post): ?>
	<article id='article_one'>
		<p id='article_content'>
			<?=$post['content']?>
		</p>
		<p id='article_poster'>
			<?=substr($post['first_name'],0,1)?> <?=$post['last_name']?> - 
			<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
				<?=Time::display($post['created'])?>
			</time>
		</p>
	</article>
<?php endforeach; ?>
</div>