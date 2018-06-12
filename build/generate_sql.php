<?php
require_once(__DIR__ . '/bootstrap.php');

/**
 * JSONからSQL生成
 */
$prefs = json_decode(file_get_contents(EXPORT_PREF_JSON), true);
$cities = json_decode(file_get_contents(EXPORT_CITIES_JSON), true);
$cityWards = json_decode(file_get_contents(EXPORT_WARDS_JSON), true);

ob_start();
?>
CREATE TABLE IF NOT EXISTS `<?= TABLE_NAME ?>` (
    `code` CHAR(6) NOT NULL,
    `type` VARCHAR(16) NOT NULL,
    `name` VARCHAR(64) NOT NULL,
    `kana` VARCHAR(64) NOT NULL,
    `pref_code` CHAR(6) NULL,
    `pref_name` VARCHAR(12) NULL,
    `pref_kana` VARCHAR(12) NULL,
    `city_code` CHAR(6) NULL,
    `city_name` VARCHAR(24) NULL,
    `city_kana` VARCHAR(24) NULL,
    `ward_code` CHAR(6) NULL,
    `ward_name` VARCHAR(24) NULL,
    `ward_kana` VARCHAR(24) NULL,
    PRIMARY KEY (`code`),
    INDEX `IX_type` (`type` ASC))
DEFAULT CHARACTER SET = utf8;
<?php
$createSql = ob_get_clean();

$insertQueries = [];
foreach ($prefs as $pref) {
    $insertQueries[] = vsprintf('INSERT INTO `%s` (`code`, `type`, `name`, `kana`, `pref_code`, `pref_name`, `pref_kana`, `city_code`, `city_name`, `city_kana`, `ward_code`, `ward_name`, `ward_kana`) VALUES ("%s", "%s", "%s", "%s", "%s", "%s", "%s", NULL, NULL, NULL, NULL, NULL, NULL);', [
        TABLE_NAME,
        $pref['code'],
        $pref['type'],
        $pref['name'],
        $pref['kana'],
        $pref['pref_code'],
        $pref['pref_name'],
        $pref['pref_kana'],
    ]);
}

foreach ($cities as $city) {
    $insertQueries[] = vsprintf('INSERT INTO `%s` (`code`, `type`, `name`, `kana`, `pref_code`, `pref_name`, `pref_kana`, `city_code`, `city_name`, `city_kana`, `ward_code`, `ward_name`, `ward_kana`) VALUES ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", NULL, NULL, NULL);', [
        TABLE_NAME,
        $city['code'],
        $city['type'],
        $city['name'],
        $city['kana'],
        $city['pref_code'],
        $city['pref_name'],
        $city['pref_kana'],
        $city['city_code'],
        $city['city_name'],
        $city['city_kana'],
    ]);
}

foreach ($cityWards as $ward) {
    $insertQueries[] = vsprintf('INSERT INTO `%s` (`code`, `type`, `name`, `kana`, `pref_code`, `pref_name`, `pref_kana`, `city_code`, `city_name`, `city_kana`, `ward_code`, `ward_name`, `ward_kana`) VALUES ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s");', [
        TABLE_NAME,
        $ward['code'],
        $ward['type'],
        $ward['name'],
        $ward['kana'],
        $ward['pref_code'],
        $ward['pref_name'],
        $ward['pref_kana'],
        $ward['city_code'],
        $ward['city_name'],
        $ward['city_kana'],
        $ward['ward_code'],
        $ward['ward_name'],
        $ward['ward_kana'],
    ]);
}

file_put_contents(EXPORT_MYSQL, $createSql . implode("\n", $insertQueries));
