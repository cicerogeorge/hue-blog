# Hue Blog
## Example application for the [Hue Framework](https://github.com/cicerogeorge/hue-framework)

This sample application consists on a blog, build to show the basic capabilities of the Hue Framework

Please refer to this Readme or the comments into the project files.

Questions and suggestions may be sent to ```cicerogeorge@gmail.com```

### Configuration

To start make a copy of ```app/config/config.json.sample``` to ```app/config/config.json``` and enter your server information. Do not forget to enable apache mod rewrite for the framework to work.

### Database

You can find a .sql dump in ```core/dump/dump.sql```.

### Routes

It is important to define at least the default system route at ```app/config/routes```. In our case the default route is defined as ```$routes['default'] = 'posts/index';```

## 1. Models

Each model reflects a database table and it is used to map the data and entities between the controllers and the database itself.

Syntax is pretty simple. Here's and example for the table ```users```:

![Image of Users database](https://raw.githubusercontent.com/cicerogeorge/public/master/Captura%20de%20Tela%202020-07-26%20a%CC%80s%2011.40.52.png)

```
<?php
namespace Application\Models;

use Core\App_Model as App_Model;

class User_Model extends App_Model {
	var $id;
	var $name;
	var $email;
	var $secret;
	var $created_at;
	var $updated_at;
	var $deleted_at;
}
```

Each database should have a plural name as each model should have the corresponding singular variation, this is important to keep consistency between the entities. If the table has multiple names (like users_groups) only the last word must be plural. If you have unreconized, irregular or made up words, just add an exception to the ```core/helper/Inflector.php``` file, into the ```$uncountable``` or ```$irregular``` arrays.

It is possible to add methods to the models, but for now let's stick to the basics.

## 2. Controllers

Controllers are the first level of the framework, which means the server will call a specific controller from each URL passed to it. The logic is very simple here:

```http://youserver/project_folder/controller_name/method_name/parameter_1/parameter_2/parameter_3/[...]/parameter_n```

So, for the url http://localhost/hue-blog/posts/index the framework will load ```Posts_Controller->index()```

Here's how this controller looks like:

```
<?php
namespace Application\Controllers;

use Core;

class Posts_Controller extends Core\App_Controller {
	public function index() {
		// loads proper view
		$this->load()->view('posts/index');
	}
```

Unilke models, controllers can be both plural, singular or made up words, as long as the camel case format is respected.

## 3. Views

When you are ready to display some data to the browser it is time to call a view. You can call as many views as you want from your controllers, but it is advised to keep it simple and have one view for each controller.

To call a view just invoke the load view method by using ```$this->load()->view('folder/file', $params)```.

The ```$params``` is optional but if parsed it should be an array. The data will be extracted as variables inside the view. For example, if you want to parse an object containing a list of posts to the view, you could proceed as follows:

```
$params = [
	'posts' => $this->load()->model('Posts')->retreive('all', ['order'=>['id'=>'DESC']]);// returns array or false
];

$this->load()->view('posts/index', $params);
```

You can then use the variable ```$posts``` on the view ```app/views/posts/index.phtml```:

```
if ($posts !== false) {
	foreach ($posts as $post){
		echo '<h2>' . $post['title'] . '<h2>';
		echo '<p>' . $post['content'] . '<p><hr>';
	}
}
else {
	echo 'No posts found';
}
```

## 4. Templates

Templates help to reuse code inside the views. You can use the helper method ```get_template($template_name, $params=array())``` to include helpers, saved at ```app/views/templates``` folder. The ```$params``` is optional here.

It is possible to pass an array of variables to the templates, much like it's done with the views.
