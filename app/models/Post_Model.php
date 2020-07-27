<?php
namespace Application\Models;

use Core\App_Model as App_Model;

class Post_Model extends App_Model {
	var $id;
	var $user_id;
	var $category_id;
	var $title;
	var $content;
	var $permalink;
	var $created_at;
	var $updated_at;
	var $deleted_at;
}