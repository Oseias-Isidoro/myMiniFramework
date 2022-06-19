# myMiniFramework
mini mvc framework

## creating a route
routes/web.php

```php
$this->add('GET', '/', HomeController::class, 'index');
```

## creating a controller
Controllers/HomeController

```php
<?php

require_once __DIR__.'/../Models/User.php';

class HomeController
{
    public function index(Request $request)
    {
        View::show('home.phtml', [
            'users' => (new User())->all()
        ]);
    }
}
```

## creating a model
Models/User.php

```php
<?php

require_once __DIR__.'/../vendor/mini-framework/Model.php';

class Product extends Model
{
    
}
```

## creating a view
views/home.phtml

```php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1><?= /** @var View $instance */ json_encode($instance->getAttribute('users')) ?></h1>
</body>
</html>
```

## run
root directory

```bash
C:\Users\my_project> cd .\public\ | php -S localhost:8000
```
