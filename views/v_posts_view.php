<div id='post_container'>
	<div id='fp_top'>
		<h2>Green Eggs - View a Post</h2>
	</div>
	<div id='article_container'>
		<article id='article_one'>
			<p id='article_content'>
				<?=$post['content']?>
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

