<?php if($user): ?>
	<div id='fp2'>
		Welcome back <?=$user->first_name;?>! We're glad you stopped by.<br>
		Click below to get to your posts --> <a href='/posts'>Goto posts</a>
	</div>
<?php else: ?>

<div id='fp1'>
	Welcome to Green Eggs MicroBlog!<br>
	Please sign in to the right or create a new account if you're new to this site.
	We're glad you stopped by. Feel free to follow other people, read their insights, and just have a good time!
	<br><br>
	The two +1 features are:<br>
	<ul>
		<li>Edit a post</li>
		<li>Delete a post</li>
	</ul>
</div>
<div id='fp2'>
	<form method='POST' action='/users/p_login'>
		username <input type="text" name="email" /> <br/>
		password <input type="password" name="password" /> <br/>
		<input type="submit" value="login">
	</form>
	<a href='reset_pw.php'>Can't access your account?</a>

	<br><br>
	<div id='signup_button'>
		<a href='/users/signup'>CREATE AN ACCOUNT</a>
	</div>
</div>


<?php endif; ?>
