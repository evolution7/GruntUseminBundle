# Evolution7GruntUseminBundle

The GruntUseminBundle contains an event listener for the kernel.controller event which prepends prod_path to the Twig template search path when in production.

This results in Twig template files processed with [grunt-usemin](https://github.com/yeoman/grunt-usemin) to be used automatically.

Check out the [Symfony Yeoman generator](https://github.com/evolution7/generator-symfony) for example usage.

## Installation

composer.json
```json
    "require": {
        "evolution7/grunt-usemin-bundle": "0.3.0"
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
    dev_path:      "app/Resources"
    prod_path:     "app/dist/Resources"
```

## License

[MIT license](https://github.com/evolution7/generator-symfony/blob/master/LICENSE)
Copyright (c) 2013, Evolution 7.
