<?php
Namespace CsvDisplayTool\CsvParser;

class CsvParser {
    public  $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function ParseCsv()
    {
        if (($open = fopen($this->fileName, "r")) !== FALSE)
        {

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
            {
                $array[] = $data;
            }

            fclose($open);
        }
        echo "<pre>";
        //To display array data
        var_dump($array);
        echo "</pre>";
    }
}