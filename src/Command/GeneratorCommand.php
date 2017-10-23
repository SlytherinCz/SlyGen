<?php

namespace SlytherinCz\SlyGen\Command;

use SlytherinCz\SlyGen\Factories\SchemaFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeneratorCommand extends Command
{
    /**
     * @var SchemaFactory
     */
    private $schemaFactory;

    public function __construct(SchemaFactory $schemaFactory)
    {
        parent::__construct();
        $this->schemaFactory = $schemaFactory;
    }

    protected function configure()
    {
        $this
            ->setName('generator:make')
            ->setDescription('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $schema = $this->schemaFactory->fromStdClass(json_decode(file_get_contents('../tmp/schema.json')));
        var_dump(json_encode($schema,JSON_PRETTY_PRINT));
        $output->writeln('YAY');
    }
}