<?php
define('ROOT', dirname(__DIR__));
const TMP = ROOT . '/tmp';
const DOWNLOAD_PAGE = 'https://www.soumu.go.jp/denshijiti/code.html';
const DOWNLOAD_LINK_TEXT = 'Excelファイル';
const DOWNLOAD_FILE = TMP . '/cities.xls';
const CITY_SHEET_INDEX = 0;
const CITY_SHEET_START_ROW = 2;
const WARD_SHEET_INDEX = 1;
const WARD_SHEET_START_ROW = 2;
const EXPORT_JSON_OPT = JSON_HEX_TAG |
    JSON_HEX_AMP |
    JSON_HEX_APOS |
    JSON_HEX_QUOT |
    JSON_PRETTY_PRINT |
    JSON_UNESCAPED_SLASHES |
    JSON_UNESCAPED_UNICODE |
    JSON_THROW_ON_ERROR;
const EXPORT_CITIES_JSON = ROOT . '/cities.json';
const EXPORT_PREF_JSON = ROOT . '/prefectures.json';
const EXPORT_WARDS_JSON = ROOT . '/wards.json';
const EXPORT_FULL_JSON = ROOT . '/index.json';
const TABLE_NAME = 'jp_local_gov_codes';
const EXPORT_MYSQL = ROOT . '/jp_local_gov_codes.mysql.sql';
const EXPORT_SQLITE = ROOT . '/jp_local_gov_codes.sqlite.sql';

require_once(ROOT . '/vendor/autoload.php');

ini_set('memory_limit', '256M');
