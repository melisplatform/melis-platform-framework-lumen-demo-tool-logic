# melis-platform-framwork-lumen-demo-tool-logic

Lumen module that handle the request of melisplatform/melis-platform-framework-lumen-demo-tool to display the list of data using a database query with the Zend Database connection configuration and the Zend Service manager

### Prerequisites

Modules required:

- melisplatform/melis-platform-framework-lumen-demo-tool
- melisplatform/melis-platform-framework

It will automatically be done when using composer

### Installing

```
composer require melisplatform/melis-platform-framework-lumen-demo-tool-logic
```

### Service Providers

To use the service provider , just add the line below in the \bootstrap\app.php file in "Register Service Providers" area.
```
$app->register(\MelisPlatformFrameworkLumenDemoToolLogic\Providers\LumenDemoToolLogicProvider::class)
```



### Route

This module has an example of Lumen route . See routes/web.php

```

Route::get('/lumen', MelisLumenController::class ."@renderMelisLumen");
```

