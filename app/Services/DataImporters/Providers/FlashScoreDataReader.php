<?php

namespace App\Services\DataImporters\Providers;

use PhpOffice\PhpSpreadsheet\IOFactory;

class FlashScoreDataReader extends AbstractDataReader
{
    public function readCsv(string $filePath): array
    {
        $lines = file($filePath);
        $data = [];

        foreach ($lines as $line) {
            $row = str_getcsv($line);
            //because of the way the csv is formatted, we need to merge the last two columns
            if (isset($data[count($data) - 1]) && count($row) === 1) {
                $data[count($data) - 1][count($data[count($data) - 1]) - 1] .= ' ' . $row[0];
            } else {
                $data[] = $row;
            }
        }

        $headers = array_shift($data);
        return array_map(fn($row) => array_combine($headers, $row), $data);
    }

    /**
     * Check if excel have multiple sheets
     * @param string $filePath
     * @return array
     */
    public function readExcel(string $filePath): array
    {
        $spreadsheet = IOFactory::load($filePath);

        $allData = [];

        foreach ($spreadsheet->getAllSheets() as $sheet) {

            $sheetName = $sheet->getTitle();
            $sheetData = $sheet->toArray(null, true, true, true);

            $headers = array_shift($sheetData);

            if (empty($headers)) {
                $allData[$sheetName] = [];
                continue;
            }

            $mappedRows = array_map(
                fn ($row) => @array_combine($headers, $row), // skipp warning in case ther are more/less columns than headers
                $sheetData
            );
            $allData[$sheetName] = $mappedRows;
        }

        return $allData;
    }
}
