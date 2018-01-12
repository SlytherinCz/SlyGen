<?php

namespace SlytherinCz\SlyGen\Services;

use Nette\PhpGenerator\PhpNamespace;
use SlytherinCz\SlyGen\Factories\RelationMethod\RelationMethodFactory;
use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Relation;
use SlytherinCz\SlyGen\Models\Resource;
use SlytherinCz\SlyGen\Models\Schema;

class ModelGenerator implements ClassGeneratorInterface
{
    /** @var  \Twig_Environment */
    private $twig;
    /**
     * @var RelationMethodFactory
     */
    private $relationMethodFactory;

    /**
     * @param \Twig_Environment $twig
     * @param RelationMethodFactory $relationMethodFactory
     */
    public function __construct(
        \Twig_Environment $twig,
        RelationMethodFactory $relationMethodFactory
    )
    {
        $this->twig = $twig;
        $this->relationMethodFactory = $relationMethodFactory;
    }

    public function generate(Schema $schema) : array
    {
        $blueprints = [];

        foreach ($schema->getResourceCollection() as $resource) {
            $namespace = $this->createNamespace($schema, $resource);

            $class = $namespace->addClass($resource->getModelClassName());

            $tableProperty = $class->addProperty('table',$resource->getName());

            $tableProperty->setVisibility('protected');

            if($resource->hasRelation())
            {
                /** @var Relation $relation */
                foreach ($resource->getRelationCollection() as $relation) {
                    $methodFactory = $this->relationMethodFactory->getFactory($relation->getType());
                    $methodFactory->create(
                        $class,
                        $relation,
                        $schema->getResourceCollection()->getResource($relation->getReference()),
                        $schema
                    );
                }
            }


            $blueprints[] = new FileBlueprint(
                $resource->getModelClassName().'.php',
                'src/Models',
                '<?php'.PHP_EOL.(string)$namespace
            );
        }

        return $blueprints;
    }

    /**
     * @param $schema
     * @param $resource
     * @return PhpNamespace
     */
    public function createNamespace(Schema $schema,Resource $resource) : PhpNamespace
    {
        $namespace = new PhpNamespace($schema->getName() . '\\Models');
        /* todo: this probably shouldnt be string literal */
        $namespace->addUse(
            'Illuminate\Database\Eloquent\Model'
        );
        return $namespace;
    }
}