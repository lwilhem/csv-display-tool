<?php
Namespace CsvDisplayTool\Command;

use CsvDisplayTool\CsvFormatter\csvFormatter;
use CsvDisplayTool\CsvParser\CsvParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

ini_set('auto_detect_line_endings',TRUE);

class DisplayCsvCommand extends Command
{
    protected static $defaultName = 'csv:display-csv';

    protected function configure(): void
    {
        $this->setDescription('Allows you to Display Csv File in CLI');
        $this->addArgument('filename', InputArgument::OPTIONAL, 'Target File');
        $this->addOption('json', 'j', InputOption::VALUE_NONE);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $parseImport = new CsvParser();
        $formatterImport = new csvFormatter();

        $parsedArray = $parseImport->csvParser($input->getArgument('filename'));
        $formattedArray = $formatterImport->formatArray($parsedArray);

        if($input->getOption('json') === true)
        {
            $encoders = [ new JsonEncoder()];
            $serializer = new Serializer([], $encoders);

            $output->writeln($serializer->serialize($formattedArray, 'json', ['json_encode_options' => \JSON_PRESERVE_ZERO_FRACTION]));
        } else {
            $table = new Table($output);
            $table
                ->setHeaders($formattedArray[0])
                ->setRow(1, $formattedArray[1])
                ->setRow(2, $formattedArray[2]);
            $table->render();
        }
        return 0;
    }
}