<div id='fp1'>
	<?php 
		switch($msg) {
			case 501:
				echo "ERROR:<br>
					Sorry, that email is already in use. Please use another email address or if 
					you have forgotten your password, use this link to retrieve it. !@#";
				break;
			case 502:
				echo "ERROR:<br>
					Please fill out all of the fields.";
				break;
			default:
				echo "Please input your user information to the right to sign up for an account.
					We're glad you're signing up!";
				break;
			}
	?>
</div>
<div id='fp2'>
	<form method='POST' action='/users/p_signup'>
		First name <input type='text' name='first_name'><br>
		Last name <input type='text' name='last_name'><br>
		Email <input type='text' name='email'><br>
		Password <input type='password' name='password'><br>
		<input type='submit' value='sign up'>
	</form>
</div>

