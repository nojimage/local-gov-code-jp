<?php
define('ROOT', dirname(__DIR__));
define('TMP', ROOT . '/tmp');
define('DOWNLOAD_PAGE', 'http://www.soumu.go.jp/denshijiti/code.html');
define('DOWNLOAD_LINK_TEXT', 'Excelファイル');
define('DOWNLOAD_FILE', TMP . '/cities.xls');
define('EXPORT_JSON_OPT', JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
define('EXPORT_CITIES_JSON', ROOT . '/cities.json');
define('EXPORT_PREF_JSON', ROOT . '/prefectures.json');
define('EXPORT_WARDS_JSON', ROOT . '/wards.json');
define('EXPORT_FULL_JSON', ROOT . '/index.json');
define('TABLE_NAME', 'jp_local_gov_codes');
define('EXPORT_MYSQL', ROOT . '/jp_local_gov_codes.mysql.sql');

require_once(ROOT . '/vendor/autoload.php');
