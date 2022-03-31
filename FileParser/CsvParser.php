<?php
Namespace CsvDisplayTool\CsvParser;

class CsvParser
{
    public function csvParser($fileName): array{
        $OutputArray = [];

        $fileHandle = fopen($fileName, "r");

        if($fileHandle == false)
        {
            die('Cannot open the file ' . $fileName);
        }

        while (($row = fgetcsv($fileHandle, null, ";")) !== false) {
            $OutputArray[] = $row;
        }
        fclose($fileHandle);
        return($OutputArray);
    }
}
