<?php
Namespace CsvDisplayTool\CsvFormatter;

class csvFormatter {
    public  $columnName;
    public $columContent;

    public function __construct($columnName, $columContent)
    {
        $this->columContent = $columContent;
        $this->columnName = $columnName;
    }

    public function FormatCsv()
    {

    }
}