<div id='post_container'>
	<div id='fp_top'>
		<h2>Green Eggs - Edit a Post</h2>
	</div>
	<div id='article_container'>
		<article id='article_one'>
			<p id='article_content'>
		<?php if ($msg==-1): ?>
			Sorry, you are not the author of this post and cannot edit this post.
		<?php else: ?>
			<form method='POST' action='/posts/p_edit_one'>
				<textarea name='content' rows='5' cols='50'><?=$post['content']?></textarea>
				<br/>
				<input type="hidden" name='post_id' value='<?=$post['post_id']?>'>
				<input type='submit' value='submit edited post'>
			</form>
		<?php endif; ?>
			</p>
			<p id='article_poster'>Created: 
				<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
					<?=Time::display($post['created'])?>
				</time>
			</p>
		</article>
	</div>
	<div id='post_menu'>
		<ul>
			<li><b>Post Menu</b></li>
			<li><a href='/posts/add/'>Add a Post</a></li>
			<li><a href='/posts/edit/'>Edit/Delete Your Posts</a></li>
			<li><a href='/posts/'>View Followed Posts</a></li>
		</ul>
	</div>

</div>

