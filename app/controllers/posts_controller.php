<?php
namespace Application\Controllers;

use Core;

class Posts_Controller extends Core\App_Controller {
	public function index() {
		// set default page for data pagination
		$_GET['page'] = isset($_GET['page']) ? $_GET['page'] : 1;

		$limit = 5;

		// this is a perfect example on how to make a simple joined select using the framework
		$post_model = $this->load()->model('Posts');

		// 1. set the main table prefix
		$post_model->join()->prefix('P');

		// 2. set the tables to join
		//    here the framework understands there is a foreign key
		//    named user_id on the main table because of the U.id key
		//    parsed into the array. The same goes for categories
		$post_model->join()->tables([
			'inner' => [
				'Users' => 'U.id',
				'Categories' => 'C.id'
			]
		]);

		// 3. select the external fields to select. By default all fields
		//    from the main table are selected
		$post_model->join()->fields(['U.name'=>'user_name', 'C.name'=>'category_name']);

		// get all posts with pagination
		$posts = $post_model->retrieve(
			'all',							// search criteria
			['order' => ['id' => 'DESC']],	// sql methods (order and group)
			$limit,							// limit
			$_GET['page']					// offset
		);

		// set variables for the view
		$params = [
			'posts' => $posts
		];

		// loads proper view
		$this->load()->view('posts/index', $params);
	}

	public function add() {
		// it is possible to use this internal post variable with sanitized data
		// default $_POST is also available
		global $__post;
		global $CONFIG;

		// requires user authentication to run the method, otherwise redirects to login
		auth('yes');

		if ($__post) {
			// forces user_id into post array
			$__post['user_id'] = $_SESSION['app']['user']['id'];

			// loads model
			$post_model = $this->load()->model('Posts');

			// this method allows for a quick value set for many variables
			$post_model->set_values($__post);

			if ($id = $post_model->create(1)) {
				redirect_to('posts/show/' . $id);
			}
		}

		$params = [
			'categories' => $this->load()->model('Categories')->retrieve('all')
		];

		$this->load()->view('posts/add', $params);
	}

	public function show($post_id) {
		// this is a perfect example on how to make a simple joined select using the framework
		$post_model = $this->load()->model('Posts');

		// 1. set the main table prefix
		$post_model->join()->prefix('P');

		// 2. set the tables to join
		//    here the framework understands there is a foreign key
		//    named user_id on the main table because of the U.id key
		//    parsed into the array. The same goes for categories
		$post_model->join()->tables([
			'inner' => [
				'Users' => 'U.id',
				'Categories' => 'C.id'
			]
		]);

		// 3. select the external fields to select. By default all fields
		//    from the main table are selected
		$post_model->join()->fields(['U.name'=>'user_name', 'C.name'=>'category_name']);

		// 4. execute the query
		$post = $post_model->retrieve(['P.id'=>$post_id]);

		$params = [
			'post' => $post[0]
		];

		$this->load()->view('posts/show', $params);
	}
}