<?php

namespace SlytherinCz\SlyGen\Services;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use SlytherinCz\SlyGen\Helpers\NamespaceDictionary;
use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Resource;
use SlytherinCz\SlyGen\Models\Schema;

class ControllerGenerator implements ClassGeneratorInterface
{

    private const HTTP_REQUEST_INTERFACE_CLASS_NAME = "Psr\Http\Message\RequestInterface";

    /** @var  \Twig_Environment */
    private $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function generate(Schema $schema): array
    {
        $blueprints = [];

        foreach ($schema->getResourceCollection() as $resource) {
            $namespace = $this->createNamespace($schema, $resource);

            $class = $namespace->addClass($resource->getControllerClassName());

            $this->addIndexMethod($class, $resource);

            $this->addShowMethod($class, $resource);

            $this->addCreateMethod($class, $resource);

            $this->addUpdateMethod($class, $resource);

            $blueprints[] = new FileBlueprint(
                $resource->getControllerClassName() . '.php',
                'src/'.NamespaceDictionary::CONTROLLER,
                '<?php' . PHP_EOL . (string)$namespace
            );

        }
        return $blueprints;
    }


    /**
     * @param $schema
     * @param $resource
     * @return PhpNamespace
     */
    public function createNamespace(Schema $schema, Resource $resource): PhpNamespace
    {
        $namespace = new PhpNamespace($schema->getName() .'\\'. NamespaceDictionary::CONTROLLER);
        $namespace->addUse(
            $schema->getName() . '\\' .NamespaceDictionary::MODEL. '\\' . $resource->getModelClassName()
        );
        $namespace->addUse(
            'Symfony\Component\HttpFoundation\Response'
        );
        return $namespace;
    }

    private function addIndexMethod(ClassType $class, Resource $resource)
    {
        $indexMethod = $class->addMethod('index');
        $indexMethod->addBody(
            $this->twig->render(
                'IndexMethod.php.twig',
                ['modelName' => $resource->getModelClassName()]
            )
        );
    }

    private function addShowMethod(ClassType $class, Resource $resource)
    {
        $showMethod = $class->addMethod('show');
        $showMethod->addParameter('id');
        $showMethod->addBody(
            $this->twig->render(
                'ShowMethod.php.twig',
                ['modelName' => $resource->getModelClassName()]
            )
        );
    }

    private function addCreateMethod(ClassType $class, Resource $resource)
    {
        $createMethod = $class->addMethod('create');
        $parameter = $createMethod->addParameter('request');
        $parameter->setTypeHint(static::HTTP_REQUEST_INTERFACE_CLASS_NAME);
        $createMethod->addBody(
            $this->twig->render(
                'CreateMethod.php.twig',
                ['modelName' => $resource->getModelClassName()]
            )
        );
    }

    private function addUpdateMethod(ClassType $class, Resource $resource)
    {
        $updateMethod = $class->addMethod('update');
        $requestParameter = $updateMethod->addParameter('request');
        $requestParameter->setTypeHint(static::HTTP_REQUEST_INTERFACE_CLASS_NAME);
        $idParameter = $updateMethod->addParameter('id');
        $updateMethod->addBody(
            $this->twig->render(
                'UpdateMethod.php.twig',
                ['modelName' => $resource->getModelClassName()]
            )
        );
    }
}