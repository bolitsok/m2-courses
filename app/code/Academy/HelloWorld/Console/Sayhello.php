<?php

namespace Academy\HelloWorld\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Academy\Helper\Helper\Data;

class Sayhello extends Command
{
    private $helper;

    public function __construct(Data $helper)
    {
        $this->helper = $helper;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('example:sayhello');
        $this->setDescription('Demo command line');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Hello World! ".$this->helper->getString());
    }
}