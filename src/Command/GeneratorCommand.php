<?php

namespace SlytherinCz\SlyGen\Command;

use SlytherinCz\SlyGen\Factories\SchemaFactory;
use SlytherinCz\SlyGen\Services\BootstrapGenerator;
use SlytherinCz\SlyGen\Services\DependencyGenerator\CredentialsGenerator;
use SlytherinCz\SlyGen\Services\DependencyGenerator\ServicesGenerator;
use SlytherinCz\SlyGen\Services\FileWriter;
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
    private $dependencyGenerator;
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
     * @param SchemaFactory $schemaFactory
     * @param CredentialsGenerator $credentialsGenerator
     * @param ServicesGenerator $servicesGenerator
     * @param FileWriter $fileWriter
     * @internal param CredentialsGenerator $dependencyGenerator
     */
    public function __construct(
        SchemaFactory $schemaFactory,
        CredentialsGenerator $credentialsGenerator,
        ServicesGenerator $servicesGenerator,
        FileWriter $fileWriter
    )
    {
        parent::__construct();
        $this->schemaFactory = $schemaFactory;
        $this->credentialsGenerator = $credentialsGenerator;
        $this->servicesGenerator = $servicesGenerator;
        $this->fileWriter = $fileWriter;
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
        $credentialsBlueprint = $this->credentialsGenerator->generate($schema);
        $servicesBlueprint = $this->servicesGenerator->generate($schema);

        $this->fileWriter->write($credentialsBlueprint,$schema->getOutputFolder());
        $this->fileWriter->write($servicesBlueprint,$schema->getOutputFolder());

        $output->writeln('YAY :)');
    }
}