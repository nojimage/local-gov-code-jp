<?php
require_once(__DIR__ . '/bootstrap.php');

/**
 * SQLのチェック(SQLite)
 */
ini_set('assert.exception', 1);

$pdo = new PDO('sqlite::memory:');
$pdo->exec(file_get_contents(EXPORT_SQLITE));

//
$query = $pdo->prepare(sprintf('SELECT * FROM `%s` WHERE code=:code', TABLE_NAME));

$query->execute([':code' => '470007']);
$result1 = $query->fetch(PDO::FETCH_ASSOC);

assert($result1 === [
    'code' => '470007',
    'type' => 'prefecture',
    'name' => '沖縄県',
    'kana' => 'おきなわけん',
    'pref_code' => '470007',
    'pref_name' => '沖縄県',
    'pref_kana' => 'おきなわけん',
    'city_code' => null,
    'city_name' => null,
    'city_kana' => null,
    'ward_code' => null,
    'ward_name' => null,
    'ward_kana' => null,
]);

$query->execute([':code' => '473821']);
$result2 = $query->fetch(PDO::FETCH_ASSOC);

assert($result2 === [
    'code' => '473821',
    'type' => 'city',
    'name' => '沖縄県与那国町',
    'kana' => 'おきなわけんよなぐにちょう',
    'pref_code' => '470007',
    'pref_name' => '沖縄県',
    'pref_kana' => 'おきなわけん',
    'city_code' => '473821',
    'city_name' => '与那国町',
    'city_kana' => 'よなぐにちょう',
    'ward_code' => null,
    'ward_name' => null,
    'ward_kana' => null,
]);

$query->execute([':code' => '431052']);
$result3 = $query->fetch(PDO::FETCH_ASSOC);

assert($result3 === [
    'code' => '431052',
    'type' => 'ward',
    'name' => '熊本県熊本市北区',
    'kana' => 'くまもとけんくまもとしきたく',
    'pref_code' => '430005',
    'pref_name' => '熊本県',
    'pref_kana' => 'くまもとけん',
    'city_code' => '431001',
    'city_name' => '熊本市',
    'city_kana' => 'くまもとし',
    'ward_code' => '431052',
    'ward_name' => '北区',
    'ward_kana' => 'きたく',
]);
