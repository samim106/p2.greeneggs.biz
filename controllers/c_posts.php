<?php

class posts_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		if(!$this->user) {
			Router::redirect('/');
		}
	}
	
	public function add() {
		$this->template->content = View::instance("v_posts_add");
		$this->template->title   = "Add a Post";
		echo $this->template;
	}

	public function p_add() {
		// check if there is content, if not, just go back to the same page
		if ($_POST['content'] == null) {
			Router::redirect('/posts/add');
		}
		// format the data
		$_POST['user_id']	= $this->user->user_id;
		$_POST['created']	= Time::now();
		$_POST['modified']	= Time::now();
		
		// add data to the db
		$index = DB::instance(DB_NAME)->insert('posts', $_POST);
		
		// redirect to view the post they just added
		Router::redirect('/posts/view/'.$index);
	}
	
	public function view($input) {
		$this->template->content = View::instance("v_posts_view");
		$this->template->title   = "View a Post";
		
		// Build the query
		$q = 'SELECT content, created, user_id, post_id
			FROM posts
			WHERE post_id = '.$input;
		
		// Run the query
		$post = DB::instance(DB_NAME)->select_row($q);

		$this->template->content->post = $post;

		echo $this->template;
	}
	
	
	public function edit() {
		$this->template->content = View::instance("v_posts_edit");
		$this->template->title   = "Edit / Delete a Post";
		
		// Build the query
		$q = 'SELECT content, created, user_id, post_id
			FROM posts
			WHERE user_id = '.$this->user->user_id;
		
		// Run the query
		$posts = DB::instance(DB_NAME)->select_rows($q);

		// Pass data to the View
		$this->template->content->posts = $posts;
		echo $this->template;
	}

	public function edit_one($errorMsg) {
		$this->template->content = View::instance("v_posts_edit_one");
		$this->template->title   = "Edit a Post";
		$this->template->content->msg = $errorMsg;
		
		// Build the query
		$q = 'SELECT content, created, user_id, post_id
			FROM posts
			WHERE post_id = '.$errorMsg;
		
		// Run the query
		$post = DB::instance(DB_NAME)->select_row($q);

		// Confirm that the user who posted it is editing it
		if (($this->user->user_id != $post['user_id']) && ($errorMsg != -1))
		{
			Router::redirect('/posts/edit_one/-1');
		}
		
		$this->template->content->post = $post;

		echo $this->template;
	}
	
	public function p_edit_one() {
		// format the data
		$data = Array(
					"content" => $_POST['content'],
					"modified" => Time::now() );
		
		// update the post
		$ret = DB::instance(DB_NAME)->update("posts", $data, "WHERE post_id = ".$_POST['post_id']);
		if ($ret != 1) {
			echo "<h2>ERROR 100: There was an error updating your post.</h2>";
		}
		else {
			Router::redirect('/posts/edit');
		}		
	}
	
	public function delete_one($errorMsg) {
		$this->template->content = View::instance("v_posts_delete_one");
		$this->template->title   = "Delete a Post";
		$this->template->content->msg = $errorMsg;
		
		// Build the query
		$q = 'SELECT content, created, user_id, post_id
			FROM posts
			WHERE post_id = '.$errorMsg;
		
		// Run the query
		$post = DB::instance(DB_NAME)->select_row($q);

		// Confirm that the user who posted it is editing it
		if (($this->user->user_id != $post['user_id']) && ($errorMsg != -1))
		{
			Router::redirect('/posts/delete_one/-1');
		}
		
		$this->template->content->post = $post;

		echo $this->template;
	}
	
	public function p_delete_one() {
		
		$ret = DB::instance(DB_NAME)->delete('posts', "WHERE post_id = ".$_POST['post_id']);
		
		if ($ret != 1) {
			echo "<h2>ERROR 110: Strange. There was nothing found to delete!</h2>";
		}
		else {
			Router::redirect('/posts/edit');
		}
	}
	
	
	public function index() {
		/*
		$this->template->content = View::instance('v_posts_index');
		
		$q = 'SELECT posts.*, users.first_name, users.last_name
				FROM posts
				INNER JOIN users
				ON posts.user_id = users.user_id';
		
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		$this->template->content->posts = $posts;
		echo $this->template;
		*/
		
		 # Set up the View
		$this->template->content = View::instance('v_posts_index');
		$this->template->title   = "Followed Posts";

		# Build the query
		$q = 'SELECT 
				posts.content,
				posts.created,
				posts.user_id AS post_user_id,
				users_users.user_id AS follower_id,
				users.first_name,
				users.last_name
			FROM posts
			INNER JOIN users_users 
				ON posts.user_id = users_users.user_id_followed
			INNER JOIN users 
				ON posts.user_id = users.user_id
			WHERE users_users.user_id = '.$this->user->user_id;
		/*
		$q = "SELECT 
				posts .* , 
				users.first_name, 
				users.last_name
			FROM posts
			INNER JOIN users 
				ON posts.user_id = users.user_id";
		*/
		
		# Run the query
		$posts = DB::instance(DB_NAME)->select_rows($q);

		# Pass data to the View
		$this->template->content->posts = $posts;

		# Render the View
		echo $this->template;
		
		/*
		 # Set up the View
		$this->template->content = View::instance('v_posts_index');
		$this->template->title   = "Green Eggs - All Posts";

		# Query
		$q = 'SELECT 
				posts.content,
				posts.created,
				posts.user_id AS post_user_id,
				users_users.user_id AS follower_id,
				users.first_name,
				users.last_name
			FROM posts
			INNER JOIN users_users 
				ON posts.user_id = users_users.user_id_followed
			INNER JOIN users 
				ON posts.user_id = users.user_id
			WHERE users_users.user_id = '.$this->user->user_id;

		# Run the query, store the results in the variable $posts
		$posts = DB::instance(DB_NAME)->select_rows($q);

		# Pass data to the View
		$this->template->content->posts = $posts;

		# Render the View
		echo $this->template;
		*/
	}
	
	public function users() {
		// set up the view
		$this->template->content = View::instance('v_posts_users');
		$this->template->title = "Green Eggs - User List";
		
		$q = 'SELECT *
				FROM users';
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		$q = 'SELECT * 
		FROM users_users
		WHERE user_id='.$this->user->user_id;
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
		
		$this->template->content->users = $users;
		$this->template->content->connections = $connections;
		
		echo $this->template;
	}

	
	public function follow($user_id_followed) {

		# Prepare the data array to be inserted
		$data = Array(
			"created" => Time::now(),
			"user_id" => $this->user->user_id,
			"user_id_followed" => $user_id_followed
			);

		# Do the insert
		DB::instance(DB_NAME)->insert('users_users', $data);

		# Send them back
		Router::redirect("/posts/users");
	}

	public function unfollow($user_id_followed) {

		# Delete this connection
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
		DB::instance(DB_NAME)->delete('users_users', $where_condition);

		# Send them back
		Router::redirect("/posts/users");

	}
		
	
	
}

?>
