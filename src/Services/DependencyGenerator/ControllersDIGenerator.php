<?php

namespace SlytherinCz\SlyGen\Services\DependencyGenerator;

use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Schema;
use SlytherinCz\SlyGen\Services\GeneratorInterface;
use Twig_Environment;

class ControllersDIGenerator implements GeneratorInterface
{

    /**
     * @var Twig_Environment
     */
    private $twig_Environment;

    /**
     * @param Twig_Environment $twig_Environment
     */
    public function __construct(Twig_Environment $twig_Environment)
    {
        $this->twig_Environment = $twig_Environment;
    }

    public function generate(Schema $schema): FileBlueprint
    {
        return new FileBlueprint(
            'controllers.yml',
            'config',
            $this->twig_Environment->render('controllers.yml.twig', ['resources' => $schema->getResourceCollection()])
        );

    }
}