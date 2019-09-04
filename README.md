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

Route::get('/melis/lumen-list', MelisLumenController::class ."@renderMelisLumen");
```

## Authors

* **Melis Technology** - [www.melistechnology.com](https://www.melistechnology.com/)

See also the list of [contributors](https://github.com/melisplatform/melis-core/contributors) who participated in this project.


## License

This project is licensed under the OSL-3.0 License - see the [LICENSE.md](LICENSE.md) file for details
