<?php

namespace SlytherinCz\SlyGen\Services;

use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Schema;

class BootstrapGenerator implements GeneratorInterface
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

    public function generate(Schema $schema): FileBlueprint
    {
        return new FileBlueprint(
            'bootstrap.php',
            'src/',
            $this->twig->render('bootstrap.php.twig',[])
        );
    }
}