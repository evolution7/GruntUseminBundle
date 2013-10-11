<?php

namespace Evolution7\GruntUseminBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use \Twig_Environment;

/**
 * This extension adds the Usemin output path to Twig file loader paths array.
 *
 * @package   GruntUseminBundle
 * @author    Ryan Djurovich <git@ryandjurovich.com>
 * @copyright 2013 - Evoution 7
 * @link      https://github.com/evolution7/gruntuseminbundle
 */
class GruntUseminExtension extends \Twig_Extension
{

    protected $container;
    protected $dev_path;
    protected $prod_path;

    /**
     * Instantiate with service container and config.
     *
     * @param ContainerInterface $container     - The service container
     * @param string             $dev_path      - Path to development files
     * @param string             $prod_path     - Path to production files
     */
    public function __construct(ContainerInterface $container, $dev_path, $prod_path)
    {
        $this->container = $container;
        $this->dev_path = $dev_path;
        $this->prod_path = $prod_path;
    }

    /**
     * Initializes the runtime environment.
     *
     * Adds the Usemin output path to Twig file loader paths array.
     *
     * @param Twig_Environment $environment - The current Twig_Environment instance
     */
    public function initRuntime(Twig_Environment $environment)
    {
        // Get environment
        $env = $this->container->getParameter('kernel.environment');
        // Only add path if production
        if ($env == 'prod') {
            // Get twig file loader
            $loader = $environment->getLoader();
            // Get default paths
            $paths = $loader->getPaths();
            $devPath = null;
            // Loop paths and find development path
            foreach ($paths AS $path) {
                // If path is development path
                if (strpos($path, $this->dev_path) !== false) {
                    $devPath = $path;
                }
            }
            // Check development path determined
            if (!is_null($devPath)) {
                // Determine production path
                $prodPath = str_replace($this->dev_path, $this->prod_path, $devPath);
                // Check path valid
                if (file_exists($prodPath)) {
                    // Add to file load path array
                    $loader->prependPath($prodPath);
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'grunt_usemin_extension';
    }

}
