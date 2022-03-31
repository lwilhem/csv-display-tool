<?php
Namespace CsvDisplayTool\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DisplayCsvCommand extends Command
{
    protected static $defaultName = 'tool:display-csv';

    protected function configure(): void
    {
        $this->setDescription('Allows you to Display Csv File in CLI');
        $this->addArgument('filename', InputArgument::REQUIRED, 'Target File');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $text = 'Hi' .$input->getArgument('filename');
        $output->writeln($text.'!');
        return 0;
    }
}