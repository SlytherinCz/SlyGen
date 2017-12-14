<?php

namespace SlytherinCz\SlyGen\Services;

use Nette\PhpGenerator\PhpNamespace;
use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Schema;

class MigrationGenerator implements GeneratorInterface
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

    public function generate(Schema $schema) : FileBlueprint
    {

        $namespace = new PhpNamespace($schema->getName() . '\\Database');
        $namespace->addUse('Illuminate\Database\Capsule\Manager as Capsule');
        $namespace->addUse('Illuminate\Database\Schema\Blueprint');
        $class = $namespace->addClass('Migration');
        $create = $class->addMethod('create');

        $create->addBody(
            $this->twig->render(
                'CreateTable.php.twig',
                ['resources' => $schema->getResourceCollection()]
                )
            );
        return new FileBlueprint(
            'Migration.php',
            'src',
            '<?php'.PHP_EOL.(string)$namespace
        );
    }
}