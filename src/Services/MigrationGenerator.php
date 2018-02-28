<?php

namespace SlytherinCz\SlyGen\Services;

use Nette\PhpGenerator\PhpNamespace;
use SlytherinCz\SlyGen\Helpers\NamespaceDictionary;
use SlytherinCz\SlyGen\Models\FileBlueprint;
use SlytherinCz\SlyGen\Models\Schema;

class MigrationGenerator
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

    /**
     * @param Schema $schema
     * @return array
     */
    public function generate(Schema $schema): array
    {
        return [
            $this->createMigrationClass($schema),
            $this->createMigrationCommand($schema)
        ];

    }

    /**
     * @param Schema $schema
     * @return FileBlueprint
     */
    private function createMigrationClass(Schema $schema)
    {
        $namespace = $this->createDatabaseNamespace($schema);
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
            'src' . DIRECTORY_SEPARATOR . NamespaceDictionary::DATABASE,
            '<?php' . PHP_EOL . (string)$namespace
        );
    }

    /**
     * @param Schema $schema
     * @return PhpNamespace
     */
    function createDatabaseNamespace(Schema $schema): PhpNamespace
    {
        $namespace = new PhpNamespace($schema->getName() . '\\' . NamespaceDictionary::DATABASE);
        $namespace->addUse('Illuminate\Database\Capsule\Manager as Capsule');
        $namespace->addUse('Illuminate\Database\Schema\Blueprint');
        return $namespace;
    }

    private function createMigrationCommand(Schema $schema)
    {
        $namespace = $this->createCommandNamespace($schema);
        $class = $namespace->addClass('MigrationCommand');
        $class->setExtends('Symfony\Component\Console\Command\Command');

        $constructMethod = $class->addMethod('__construct');
        $migrationParameter = $constructMethod->addParameter('migration');
        $migrationParameter->setTypeHint($schema->getName() . '\\' . NamespaceDictionary::DATABASE . '\\Migration');
        $constructMethod->addBody($this->twig->render('MigrationCommandConstructor.twig', []));

        $configureMethod = $class->addMethod('configure');
        $configureMethod->addBody($this->twig->render('MigrationCommandConfigureMethod.twig', []));

        $executeMethod = $class->addMethod('execute');
        $inputParameter = $executeMethod->addParameter('input');
        $inputParameter->setTypeHint('Symfony\Component\Console\Input\InputInterface');
        $outputParameter = $executeMethod->addParameter('output');
        $outputParameter->setTypeHint('Symfony\Component\Console\Output\OutputInterface');

        $executeMethod->addBody($this->twig->render('MigrationCommandExecuteMethod.twig', []));
        return new FileBlueprint(
            'MigrationCommand.php',
            'src' . DIRECTORY_SEPARATOR . NamespaceDictionary::COMMAND,
            '<?php' . PHP_EOL . (string)$namespace
        );
    }

    private function createCommandNamespace(Schema $schema)
    {
        $namespace = new PhpNamespace($schema->getName() . '\\' . NamespaceDictionary::COMMAND);
        return $namespace;
    }
}