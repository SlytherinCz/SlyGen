<?php

namespace SlytherinCz\SlyGen\Services;

use SlytherinCz\SlyGen\Helpers\NamespaceDictionary;
use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Schema;

/**
 * Class EntrypointGenerator
 * @package SlytherinCz\SlyGen\Services
 */
class EntrypointGenerator
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Schema $schema
     * @return array
     */
    public function generate(Schema $schema): array
    {
        return [
            new FileBlueprint(
                'index.php',
                '/',
                $this->twig->render('index.php.twig')
            ),
            new FileBlueprint(
                'console.php',
                'bin/',
                $this->twig->render(
                    'console.php.twig',
                    [
                        'commandNamespace' => $schema->getName() . '\\' . NamespaceDictionary::COMMAND,
                        'databaseNamespace' => $schema->getName() . '\\' . NamespaceDictionary::DATABASE
                    ]
                )
            )
        ];
    }
}