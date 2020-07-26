# Hue Blog
## Example application for the [Hue Framework](https://github.com/cicerogeorge/hue-framework)

This sample application consists on a blog, build to show the basic capabilities of the Hue Framework

Please refer to this Readme or the comments into the project files.

Questions and suggestions may be sent to ```cicerogeorge@gmail.com```

## 1. Models

Each model reflects a database table and it is used to map the ata and entities between the controllers and the database itself.

Syntax is pretty simple. Here's and example for the table ```users```:

![Image of Users database]
(https://raw.githubusercontent.com/cicerogeorge/public/master/Captura%20de%20Tela%202020-07-26%20a%CC%80s%2011.40.52.png)

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

Each database should have a plural name as each model should have the corresponding singular variation, this is important to keep consistency between the entities