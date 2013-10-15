<?php

namespace Evolution7\GruntUseminBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * This extension adds the Usemin output path to Twig file loader paths array.
 *
 * @package   GruntUseminBundle
 * @author    Ryan Djurovich <git@ryandjurovich.com>
 * @copyright 2013 - Evoution 7
 * @link      https://github.com/evolution7/gruntuseminbundle
 */
class GruntUseminListener implements EventSubscriberInterface
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
    public function __construct($container, $dev_path, $prod_path)
    {
        $this->container = $container;
        $this->dev_path = $dev_path;
        $this->prod_path = $prod_path;
    }

    /**
     * Adds the Usemin output path to Twig file loader paths array.
     *
     * @param FilterControllerEvent $event A FilterControllerEvent instance
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        // Get environment
        $env = $this->container->getParameter('kernel.environment');
        // Only add path if production
        if ($env == 'prod') {
            // Get twig environment
            $twig = $this->container->get('twig');
            // Get twig file loader
            $loader = $twig->getLoader();
            // Get namespaces
            $namespaces = $loader->getNamespaces();
            // Loop namespaces
            foreach ($namespaces AS $ns) {
                // Get namespace paths
                $paths = $loader->getPaths($ns);
                // Loop paths
                foreach ($paths AS $path) {
                    // If path is contains development path
                    if (strpos($path, $this->dev_path) !== false) {
                        // Determine production path
                        $prodPath = str_replace($this->dev_path, $this->prod_path, $path);
                        // Check path valid
                        if (file_exists($prodPath)) {
                            // Add to file load path array
                            $loader->prependPath($prodPath, $ns);
                        }
                    }
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
        );
    }
}
