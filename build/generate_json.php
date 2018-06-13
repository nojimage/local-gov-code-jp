<?php
require_once(__DIR__ . '/bootstrap.php');

/**
 * ExcelシートからJSON生成
 */
use Cake\Utility\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;

$reader = IOFactory::createReaderForFile(DOWNLOAD_FILE);

$spreadsheet = $reader->load(DOWNLOAD_FILE);

// - 都道府県-市区町村
$citiesSheet = $spreadsheet->getSheet(0);
$prefs = [];
$cities = [];

$citiesRows = $citiesSheet->getRowIterator(2);
foreach ($citiesRows as $row) {
    /* @var $row Row */
    $rowIdx = $row->getRowIndex();
    $code = $citiesSheet->getCell('A' . $rowIdx)->getValue();
    $prefName = $citiesSheet->getCell('B' . $rowIdx)->getValue();
    $cityName = $citiesSheet->getCell('C' . $rowIdx)->getValue();
    $prefKana = mb_convert_kana($citiesSheet->getCell('D' . $rowIdx)->getValue(), 'HVcas');
    $cityKana = mb_convert_kana($citiesSheet->getCell('E' . $rowIdx)->getValue(), 'HVcas');
    if (empty($cityName)) {
        $prefs[$prefName] = [
            'type' => 'prefecture',
            'code' => $code,
            'name' => $prefName,
            'kana' => $prefKana,
            'pref_code' => $code,
            'pref_name' => $prefName,
            'pref_kana' => $prefKana,
        ];
    } else {
        $city = [
            'type' => 'city',
            'code' => $code,
            'name' => $prefName . $cityName,
            'kana' => $prefKana . $cityKana,
            'city_code' => $code,
            'city_name' => $cityName,
            'city_kana' => $cityKana,
            'pref_code' => $prefs[$prefName]['code'],
            'pref_name' => $prefName,
            'pref_kana' => $prefKana,
        ];
        $cities[] = $city;
    }
}

// - 政令指定都市
$designatedCitiesSheet = $spreadsheet->getSheet(1);
$cityWards = [];
$cityNames = Hash::combine($cities, '{n}.city_name', '{n}');

$designatedCitiesRows = $designatedCitiesSheet->getRowIterator(2);
foreach ($designatedCitiesRows as $row) {
    /* @var $row Row */
    $rowIdx = $row->getRowIndex();
    $code = $designatedCitiesSheet->getCell('A' . $rowIdx)->getValue();
    $name = $designatedCitiesSheet->getCell('B' . $rowIdx)->getValue();
    $kana = mb_convert_kana($designatedCitiesSheet->getCell('C' . $rowIdx)->getValue(), 'HVcas');
    if (preg_match('/^(.+市)(.+区)$/', $name, $matches)) {
        $cityName = $matches[1];
        $wardName = $matches[2];
        $city = $cityNames[$cityName];
        $wardKana = preg_replace('/\A' . $city['city_kana'] . '/', '', $kana);
        $cityWards[] = [
            'type' => 'ward',
            'code' => $code,
            'name' => $city['pref_name'] . $name,
            'kana' => $city['pref_kana'] . $kana,
            'ward_code' => $code,
            'ward_name' => $wardName,
            'ward_kana' => $wardKana,
            'city_code' => $city['code'],
            'city_name' => $city['city_name'],
            'city_kana' => $city['city_kana'],
            'pref_code' => $city['pref_code'],
            'pref_name' => $city['pref_name'],
            'pref_kana' => $city['pref_kana'],
        ];
    }
}

// EXPORT
file_put_contents(EXPORT_PREF_JSON, json_encode(array_values($prefs), EXPORT_JSON_OPT));
file_put_contents(EXPORT_CITIES_JSON, json_encode(array_values($cities), EXPORT_JSON_OPT));
file_put_contents(EXPORT_WARDS_JSON, json_encode(array_values($cityWards), EXPORT_JSON_OPT));
