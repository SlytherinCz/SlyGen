<?php

namespace SlytherinCz\SlyGen\Services;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Resource;
use SlytherinCz\SlyGen\Models\Schema;

class ControllerGenerator
{
    /** @var  \Twig_Environment */
    private $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function generate(Schema $schema) : array
    {
        $blueprints = [];

        foreach ($schema->getResourceCollection() as $resource) {
            $namespace = $this->createNamespace($schema,$resource);

            $class = $namespace->addClass($this->getControllerClassName($resource));

            $this->addIndexMethod($class,$resource);

            $this->addShowMethod($class,$resource);

            $this->addCreateMethod($class,$resource);

            $this->addUpdateMethod($class,$resource);

            /* todo:  this belongs to model generator, not here */
            /*
                $tableProperty = $class->addProperty('table', $resource->getName());
                $tableProperty->setVisibility('private');
            */


            $blueprints[] = new FileBlueprint(
                $this->getControllerClassName($resource).'.php',
                'src/Controllers',
                '<?php'.PHP_EOL.(string)$namespace
            );

        }
        return $blueprints;
    }

    private function getModelAlias(Resource $resource):string
    {
        return ucfirst($resource->getName()).'Model';
    }

    private function getControllerClassName(Resource $resource) : string
    {
        return ucfirst($resource->getName()).'Controller';
    }

    /**
     * @param $schema
     * @param $resource
     * @return PhpNamespace
     */
    private function createNamespace($schema, $resource)
    {
        $namespace = new PhpNamespace($schema->getName() . '\\Controllers');
        $namespace->addUse(
            $schema->getName().'\\Models\\'.ucfirst($resource->getName()),
            $this->getModelAlias($resource)
        );
        return $namespace;
    }

    private function addIndexMethod(ClassType $class,Resource $resource)
    {
        $indexMethod = $class->addMethod('index');
        $indexMethod->addBody(
            $this->twig->render(
                'IndexMethod.php.twig',
                ['modelName' => $this->getModelAlias($resource)]
            )
        );
    }

    private function addShowMethod(ClassType $class, Resource $resource)
    {
        $showMethod = $class->addMethod('show');
        $showMethod->addParameter('id');
        $showMethod->setReturnType($this->getModelAlias($resource));
        $showMethod->addBody(
            $this->twig->render(
                'ShowMethod.php.twig',
                ['modelName' => $this->getModelAlias($resource)]
            )
        );
    }

    private function addCreateMethod(ClassType $class, Resource $resource)
    {
        $createMethod = $class->addMethod('create');
        $parameter = $createMethod->addParameter('request');
        /* todo: need to figure out what class is Request an alias for, depending on used framework */
        $parameter->setTypeHint('Request');
        $createMethod->setReturnType($this->getModelAlias($resource));
        $createMethod->addBody(
            $this->twig->render(
                'CreateMethod.php.twig',
                ['modelName' => $this->getModelAlias($resource)]
            )
        );
    }

    private function addUpdateMethod(ClassType $class, Resource $resource)
    {
        $updateMethod = $class->addMethod('update');
        $requestParameter = $updateMethod->addParameter('request');
        /* todo: need to figure out what class is Request an alias for, depending on used framework */
        $requestParameter->setTypeHint('Request');
        $idParameter = $updateMethod->addParameter('id');
        $updateMethod->setReturnType($this->getModelAlias($resource));
        $updateMethod->addBody(
            $this->twig->render(
                'UpdateMethod.php.twig',
                ['modelName' => $this->getModelAlias($resource)]
            )
        );
    }
}