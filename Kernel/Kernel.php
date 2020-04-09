<?php

namespace Norival\Phable\Kernel;

use Norival\Phable\Exceptions\NoRouteException;
use Norival\Phable\Router\Router;

/**
 * Kernel class
 *
 * @author Xavier Laviron <xavier@norival.dev>
 */
class Kernel
{
    private \Norival\Phable\Router\Router $router;

    public function __construct()
    {
    }

    /**
     * Boot the kernel: load configuration, instantiate the router and load
     * routes definitions
     *
     * @return self
     */
    public function boot(string $configFile): self
    {
        // TODO load configuration

        // TODO load routes from php file
        if (!\file_exists($configFile)) {
            throw new NoRouteException('No route configuration file found');
        }

        // instantiate the Router
        $this->router = new Router();

        require $configFile;

        foreach ($routes as $name => $route) {
            $this->router->addRoute(
        }

        return $this;
    }

    /**
     * Handle the request
     *
     * @return void
     */
    public function handleRequest(): void
    {
        // TODO constuct a request object and call the router
    }
}