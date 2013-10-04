<?php

namespace Evolution7\GruntUseminBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * This extension provides a custom Twig function for loading
 * Grunt Usemin manifest files.
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
    protected $manifests_dir;

    /**
     * Instantiate with service container and config.
     *
     * @param ContainerInterface $container     - The service container
     * @param string             $dev_path      - Path to base directory for frontend development files
     * @param string             $prod_path     - Path to base directory for frontend production files
     * @param string             $manifests_dir - Directory holding manifests for dev/prod path
     */
    public function __construct(ContainerInterface $container, $dev_path, $prod_path, $manifests_dir)
    {
        $this->container = $container;
        $this->dev_path = $dev_path;
        $this->prod_path = $prod_path;
        $this->manifests_dir = $manifests_dir;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('include_manifest', array($this, 'includeManfiest')),
        );
    }

    /**
     * Function which maps to Twig include_manifests function
     *
     * @param string $filename - name of manifest file (with or without .html extension)
     */
    public function includeManfiest($filename)
    {

        // Append .html to filename is not present
        $filename .= (strpos($filename, '.html') === false ? '.html' : '');

        // Get path based on environment
        $env = $this->container->getParameter('kernel.environment');
        $path = ($env == 'prod' ? $this->prod_path : $this->dev_path);
        
        // Get file path
        $filepath = dirname($this->container->getParameter('kernel.root_dir')) . "/"
                  . $path . "/"
                  . $this->manifests_dir . "/"
                  . $filename;

        // Check file exists
        if (file_exists($filepath)) {

          // Include file
          include $filepath;

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
