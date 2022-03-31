<?php
Namespace CsvDisplayTool\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DisplayCsvCommand extends Command
{
    protected static $defaultName = 'csv:display-csv';

    protected function configure(): void
    {
        $this->setDescription('Allows you to Display Csv File in CLI');
        $this->addArgument('filename', InputArgument::REQUIRED, 'Target File');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $table = new Table($output);
        $table
            ->setHeaders(['Sku', 'Status', 'Price', 'Description', 'CreatedAt', 'slug'])
        ;
        $table->render();
        return 0;
    }
}