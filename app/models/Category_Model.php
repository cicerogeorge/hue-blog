<?php
namespace Application\Models;

use Core\App_Model as App_Model;

class Category_Model extends App_Model {
	var $id;
	var $name;
	var $about;
	var $permalink;
	var $created_at;
	var $updated_at;
	var $deleted_at;
}