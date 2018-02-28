<?php

namespace SlytherinCz\SlyGen\Services\DependencyGenerator;

use SlytherinCz\SlyGen\Helpers\HttpMethodMapping;
use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Route;
use SlytherinCz\SlyGen\Models\Schema;

class RoutingGenerator
{
    /** @var  \Twig_Environment */
    private $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(
        \Twig_Environment $twig
    ) {
        $this->twig = $twig;
    }

    public function generate(Schema $schema): FileBlueprint
    {
        $routes = [];
        /** @var Resource $resource */
        foreach ($schema->getResourceCollection() as $resource) {
            foreach ([
                         HttpMethodMapping::CREATE,
                         HttpMethodMapping::DELETE,
                         HttpMethodMapping::SHOW,
                         HttpMethodMapping::INDEX,
                         HttpMethodMapping::UPDATE
                     ] as $method) {
                $name = $resource->getName() . '_' . $method['controllerMethod'];
                $controller = $resource->getFullyQualifiedControllerClassName() . '::' . $method['controllerMethod'];
                $path = '/' . strtolower($resource->getName()) . ($method['requiresSlug'] ? '/{:id}' : '');
                $route = new Route(
                    $name,
                    $path,
                    $controller,
                    $method['httpMethod']
                );
                $routes[] = $route;
            }
        }

        return new FileBlueprint(
            'routing.yml',
            'config',
            $this->twig->render(
                'routing.yml.twig',
                ['routes' => $routes]
            )
        );
    }

}