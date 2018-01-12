<?php

namespace SlytherinCz\SlyGen\Factories\RelationMethod;

use Nette\PhpGenerator\ClassType;
use SlytherinCz\SlyGen\Helpers\ResourceModelNameHelper;
use SlytherinCz\SlyGen\Models\Relation;
use SlytherinCz\SlyGen\Models\Resource;
use SlytherinCz\SlyGen\Models\Schema;


class ManyToOneRelationMethodFactory implements RelationMethodFactoryInterface
{
    const SUPPORTS = 'M21';

    /** @var  \Twig_Environment */
    private $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }


    public function create(ClassType $class, Relation $relation, Resource $reference,Schema $schema)
    {
        $relationMethod = $class->addMethod($reference->getName());
        $relationMethod->setVisibility('public');
        $relationMethod->addBody(
            $this->twig->render(
                'M21.php.twig',
                [
                    'referenceName' => ResourceModelNameHelper::getFullyQualifiedModelName($schema,$relation->getReference())
                ]
            )
        );
    }

    public function supports(string $relationType): bool
    {
        return $relationType === self::SUPPORTS;
    }
}