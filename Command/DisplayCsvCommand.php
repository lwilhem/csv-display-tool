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
        $this->addArgument('filename', InputArgument::OPTIONAL, 'Target File');
    }

    private $csvParsingOptions = array(
        'ignoreFirstLine' => true
    );


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $csv = $this->parseCSV($input->getArgument('filename'));
        var_dump($csv);

        $table = new Table($output);
        $table
            ->setHeaders(['Sku', 'Status', 'Price', 'Description', 'CreatedAt', 'slupg'])
            ->setRows($csv)
        ;
        $table->render();
        return 0;
    }

    private function parseCSV($fileName): array
    {
        $ignore = $this->csvParsingOptions['ignoreFirstLine'];
        $rows = array();

        if(($handle = fopen($fileName, "r")) !== false)
        {
            $i=0;
            while(($data = fgetcsv($handle, null, ';')) !== false)
            {
                $i++;
                if ($ignore && $i == 1) { continue; }
                $rows[] = $data;
            }
            fclose($handle);
        }
        return $rows;
    }
}