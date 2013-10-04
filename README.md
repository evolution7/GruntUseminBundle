# Evolution7GruntUseminBundle

The GruntUseminBundle provides an `include_manifest` Twig helper function for including [grunt-usemin](https://github.com/yeoman/grunt-usemin) manifest files based on environment.

## Installation

composer.json
```json
    "require": {
        "evolution7/grunt-usemin-bundle": "1.0.*"
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

Create any necessary html manifest files (to be parsed by useminPrepare/usemin Grunt tasks), configure your Gruntfile to process these, and configure this bundle to look for the development (aka "app") and production (aka "dist") versions.

### Default Bundle Configuration

```yaml
evolution7_grunt_usemin:
    dev_path:      "web"
    prod_path:     "web/dist"
    manifests_dir: "manifests"
```
