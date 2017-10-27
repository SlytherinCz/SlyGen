<?php

namespace SlytherinCz\SlyGen\Services\DependencyGenerator;

use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Schema;
use Twig_Environment;

class ServicesGenerator
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

    public function generate(Schema $schema) : FileBlueprint
    {
        return new FileBlueprint(
            'services.yml',
            'config',
            $this->twig_Environment->render('services.yml.twig',(array)$schema->getCredentials())
        );

    }
}