<?php
define('ROOT', dirname(__DIR__));
define('TMP', ROOT . '/tmp');
define('DOWNLOAD_PAGE', 'https://www.soumu.go.jp/denshijiti/code.html');
define('DOWNLOAD_LINK_TEXT', 'Excelファイル');
define('DOWNLOAD_FILE', TMP . '/cities.xls');
define('CITY_SHEET_INDEX', 0);
define('CITY_SHEET_START_ROW', 2);
define('WARD_SHEET_INDEX', 1);
define('WARD_SHEET_START_ROW', 2);
define('EXPORT_JSON_OPT', JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
define('EXPORT_CITIES_JSON', ROOT . '/cities.json');
define('EXPORT_PREF_JSON', ROOT . '/prefectures.json');
define('EXPORT_WARDS_JSON', ROOT . '/wards.json');
define('EXPORT_FULL_JSON', ROOT . '/index.json');
define('TABLE_NAME', 'jp_local_gov_codes');
define('EXPORT_MYSQL', ROOT . '/jp_local_gov_codes.mysql.sql');
define('EXPORT_SQLITE', ROOT . '/jp_local_gov_codes.sqlite.sql');

require_once(ROOT . '/vendor/autoload.php');

ini_set('memory_limit', '256M');
