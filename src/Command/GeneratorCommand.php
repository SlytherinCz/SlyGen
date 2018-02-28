<?php

namespace SlytherinCz\SlyGen\Command;

use SlytherinCz\SlyGen\Factories\SchemaFactory;
use SlytherinCz\SlyGen\Models\Schema;
use SlytherinCz\SlyGen\Services\BootstrapGenerator;
use SlytherinCz\SlyGen\Services\ControllerGenerator;
use SlytherinCz\SlyGen\Services\DependencyGenerator\ControllersDIGenerator;
use SlytherinCz\SlyGen\Services\DependencyGenerator\CredentialsGenerator;
use SlytherinCz\SlyGen\Services\DependencyGenerator\RoutingGenerator;
use SlytherinCz\SlyGen\Services\DependencyGenerator\ServicesGenerator;
use SlytherinCz\SlyGen\Services\EntrypointGenerator;
use SlytherinCz\SlyGen\Services\FileWriter;
use SlytherinCz\SlyGen\Services\MigrationGenerator;
use SlytherinCz\SlyGen\Services\ModelGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeneratorCommand extends Command
{
    /**
     * @var SchemaFactory
     */
    private $schemaFactory;
    /**
     * @var BootstrapGenerator
     */
    private $bootstrapGenerator;
    /**
     * @var CredentialsGenerator
     */
    private $credentialsGenerator;
    /**
     * @var ServicesGenerator
     */
    private $servicesGenerator;
    /**
     * @var FileWriter
     */
    private $fileWriter;
    /**
     * @var MigrationGenerator
     */
    private $migrationGenerator;
    /**
     * @var ControllerGenerator
     */
    private $controllerGenerator;
    /**
     * @var ControllersDIGenerator
     */
    private $controllersDIGenerator;
    /**
     * @var ModelGenerator
     */
    private $modelGenerator;
    /**
     * @var RoutingGenerator
     */
    private $routingGenerator;
    /**
     * @var EntrypointGenerator
     */
    private $entrypointGenerator;

    /**
     * @param SchemaFactory $schemaFactory
     * @param CredentialsGenerator $credentialsGenerator
     * @param ServicesGenerator $servicesGenerator
     * @param MigrationGenerator $migrationGenerator
     * @param ControllerGenerator $controllerGenerator
     * @param ControllersDIGenerator $controllersDIGenerator
     * @param ModelGenerator $modelGenerator
     * @param RoutingGenerator $routingGenerator
     * @param BootstrapGenerator $bootstrapGenerator
     * @param EntrypointGenerator $entrypointGenerator
     * @param FileWriter $fileWriter
     */
    public function __construct(
        SchemaFactory $schemaFactory,
        CredentialsGenerator $credentialsGenerator,
        ServicesGenerator $servicesGenerator,
        MigrationGenerator $migrationGenerator,
        ControllerGenerator $controllerGenerator,
        ControllersDIGenerator $controllersDIGenerator,
        ModelGenerator $modelGenerator,
        RoutingGenerator $routingGenerator,
        BootstrapGenerator $bootstrapGenerator,
        EntrypointGenerator $entrypointGenerator,
        FileWriter $fileWriter
    ) {
        parent::__construct();
        $this->schemaFactory = $schemaFactory;
        $this->credentialsGenerator = $credentialsGenerator;
        $this->servicesGenerator = $servicesGenerator;
        $this->fileWriter = $fileWriter;
        $this->migrationGenerator = $migrationGenerator;
        $this->controllerGenerator = $controllerGenerator;
        $this->controllersDIGenerator = $controllersDIGenerator;
        $this->modelGenerator = $modelGenerator;
        $this->routingGenerator = $routingGenerator;
        $this->bootstrapGenerator = $bootstrapGenerator;
        $this->entrypointGenerator = $entrypointGenerator;
    }

    protected function configure()
    {
        $this
            ->setName('generator:make')
            ->setDescription('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $schema = $this->schemaFactory->fromStdClass(json_decode(file_get_contents('tmp/schema.json')));

        $this->generateMigrationFiles($schema);

        $this->generateDependencyInjectionFiles($schema);

        $this->generateControllerFiles($schema);

        $this->generateModelFiles($schema);

        $this->generateBootstrapFile($schema);

        $this->generateEntrypointFiles($schema);


        $output->writeln('YAY :)');
    }

    /**
     * @param Schema $schema
     */
    private function generateMigrationFiles(Schema $schema)
    {
        foreach ($this->migrationGenerator->generate($schema) as $migrationBlueprint) {
            $this->fileWriter->write($migrationBlueprint, $schema->getOutputFolder());
        }
    }

    /**
     * @param $schema
     */
    private function generateDependencyInjectionFiles(Schema $schema)
    {
        $this->fileWriter->write($this->credentialsGenerator->generate($schema), $schema->getOutputFolder());
        $this->fileWriter->write($this->servicesGenerator->generate($schema), $schema->getOutputFolder());
        $this->fileWriter->write($this->controllersDIGenerator->generate($schema), $schema->getOutputFolder());
        $this->fileWriter->write($this->routingGenerator->generate($schema), $schema->getOutputFolder());
    }

    /**
     * @param Schema $schema
     */
    private function generateControllerFiles(Schema $schema)
    {
        foreach ($this->controllerGenerator->generate($schema) as $controllerBlueprint) {
            $this->fileWriter->write($controllerBlueprint, $schema->getOutputFolder());
        }
    }

    /**
     * @param Schema $schema
     */
    private function generateModelFiles(Schema $schema)
    {
        foreach ($this->modelGenerator->generate($schema) as $modelBlueprint) {
            $this->fileWriter->write($modelBlueprint, $schema->getOutputFolder());
        }
    }

    /**
     * @param Schema $schema
     */
    private function generateBootstrapFile(Schema $schema)
    {
        $this->fileWriter->write($this->bootstrapGenerator->generate($schema), $schema->getOutputFolder());
    }

    /**
     * @param Schema $schema
     */
    private function generateEntrypointFiles(Schema $schema)
    {
        foreach ($this->entrypointGenerator->generate($schema) as $entrypointBlueprint) {
            $this->fileWriter->write($entrypointBlueprint, $schema->getOutputFolder());
        }
    }
}