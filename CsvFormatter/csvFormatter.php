<?php
Namespace CsvDisplayTool\CsvFormatter;

use Cassandra\Date;
use DateTime;

class csvFormatter {

    public function slugFormat(string $slug):string
    {

        $output = str_replace(array(',', ';', '<', '>', '/'),'' , strtolower($slug));
        return str_replace(' ', '-', $output);
    }

    public function PriceFormat(string $value): string
    {
       $input = (float) $value;
       $output = number_format($input, 2, ',', ' ');
       return $output. " €";
    }
    public function dateFormat($dateTime)
    {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateTime);
        return date_format($date, 'l, d-M-Y H:i:s e');
    }

    public function formatStatus($isEnabled):string
    {
        if($isEnabled)
        {
            return "Enable";
        } else {
            return "disable";
        }
    }

    public function descriptionFormat($toFormat): string
    {
        return nl2br($toFormat, false);
    }

    public function formatArray($toFormatArray): array
    {
        unset($toFormatArray[0][4]);
        unset($toFormatArray[1][4]);
        unset($toFormatArray[2][4]);
        $toFormatArray = array_values($toFormatArray);

        $toFormatArray[0][] = 'slug';
        $toFormatArray[1][] = $this->slugFormat($toFormatArray[1][1]);
        $toFormatArray[2][] = $this->slugFormat($toFormatArray[2][1]);

        $toFormatArray[1][3] = $this->PriceFormat($toFormatArray[1][3]);
        $toFormatArray[2][3] = $this->PriceFormat($toFormatArray[2][3]);

        $toFormatArray[1][6] = $this->dateFormat($toFormatArray[1][6]);
        $toFormatArray[2][6] = $this->dateFormat($toFormatArray[2][6]);

        $toFormatArray[1][2] = $this->formatStatus($toFormatArray[1][2]);
        $toFormatArray[2][2] = $this->formatStatus($toFormatArray[2][2]);

        $toFormatArray[1][5] = $this->descriptionFormat($toFormatArray[1][5]);
        $toFormatArray[2][5] = $this->descriptionFormat($toFormatArray[2][5]);



        return $toFormatArray;
    }
}