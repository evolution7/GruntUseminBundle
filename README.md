# Evolution7GruntUseminBundle

The GruntUseminBundle contains a Twig extension for using files processed with [grunt-usemin](https://github.com/yeoman/grunt-usemin) when in production.

Check out the [Symfony Yeoman generator](https://github.com/evolution7/generator-symfony) for example usage.

## Installation

composer.json
```json
    "require": {
        "evolution7/grunt-usemin-bundle": "0.2.0"
    },
```

AppKernel.php:
```php
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Evolution7\GruntUseminBundle\Evolution7GruntUseminBundle(),
            // ...
        );
```

### Default Bundle Configuration

```yaml
evolution7_grunt_usemin:
    dev_path:      "app/Resources/views"
    prod_path:     "app/dist/Resources/views"
```

## License

[MIT license](https://github.com/evolution7/generator-symfony/blob/master/LICENSE)
Copyright (c) 2013, Evolution 7.
