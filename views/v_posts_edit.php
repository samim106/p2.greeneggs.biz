<div id='article_container'>
<?php if ($posts==null) {
		echo "You have not created any posts.";
	} ?>
<?php foreach($posts as $post): ?>
	<article id='article_one'>
		<p id='article_content'>
			<?=$post['content']?>
		</p>
		<p id='article_poster'>
			<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
				<?=Time::display($post['created'])?>
			</time>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='/posts/delete_one/<?=$post['post_id']?>'>Delete</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='/posts/edit_one/<?=$post['post_id']?>'>Edit</a>
		</p>
	</article>
<?php endforeach; ?>
</div>