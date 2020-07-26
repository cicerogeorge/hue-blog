# Hue Blog
## Example application for the [Hue Framework](https://github.com/cicerogeorge/hue-framework)

This sample application consists on a blog, build to show the basic capabilities of the Hue Framework

Please refer to this Readme or the comments into the project files.

Questions and suggestions may be sent to ```cicerogeorge@gmail.com```

### Configuration

To start make a copy of ```appp/config/config.json.sample``` to ```app/config/config.json``` and enter your server information. Do not forget to enable apache mod rewrite for the framework to work.

### Database

You can find a .sql dump in ```core/dump/dump.sql```.

## 1. Models

Each model reflects a database table and it is used to map the ata and entities between the controllers and the database itself.

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

Each database should have a plural name as each model should have the corresponding singular variation, this is important to keep consistency between the entities.
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

When you are ready to display some data to the browser it is time to call a view. You can call as much views as you want from your controllers, but it is advised to keep it simple and have one view for each controller.

To call a view just invoke the load view method by using ```$this->load()->view('folder/file')```.
