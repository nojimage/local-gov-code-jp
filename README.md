# Local government codes in Japan

<p align="center">
    <a href="https://travis-ci.org/nojimage/local-gov-code-jp" target="_blank">
        <img alt="Build Status" src="https://img.shields.io/travis/nojimage/local-gov-code-jp/master.svg?style=flat-square">
    </a>
    <a href="https://packagist.org/packages/nojimage/local-gov-code-jp" target="_blank">
        <img alt="Latest Stable Version" src="https://img.shields.io/packagist/v/nojimage/local-gov-code-jp.svg?style=flat-square">
    </a>
</p>

総務省の提供する全国地方公共団体コードをJSON化したものです。

[総務省｜電子自治体｜全国地方公共団体コード](http://www.soumu.go.jp/denshijiti/code.html)

都道府県コード及び市区町村コード（令和元年5月1日現在）をベースに作成しています。

- prefectures.json 都道府県コード
- cities.json 市区町村コード
- wards.json 政令指定都市の区コード
- index.json 上記prefectures, cities, wardsを結合したもの
- jp_local_gov_codes.mysql.sql MySQL用テーブル定義＋データ
- jp_local_gov_codes.sqlite.sql SQLite用テーブル定義＋データ

を提供します。

## Data Example

### prefectures.json

```json
[
    {
        "type": "prefecture",
        "code": "010006",
        "name": "北海道",
        "kana": "ほっかいどう",
        "pref_code": "010006",
        "pref_name": "北海道",
        "pref_kana": "ほっかいどう"
    },
    {
        "type": "prefecture",
        "code": "020001",
        "name": "青森県",
        "kana": "あおもりけん",
        "pref_code": "020001",
        "pref_name": "青森県",
        "pref_kana": "あおもりけん"
    },
// ...
```

### cities.json

```json
[
    {
        "type": "city",
        "code": "011002",
        "name": "北海道札幌市",
        "kana": "ほっかいどうさっぽろし",
        "city_code": "011002",
        "city_name": "札幌市",
        "city_kana": "さっぽろし",
        "pref_code": "010006",
        "pref_name": "北海道",
        "pref_kana": "ほっかいどう"
    },
    {
        "type": "city",
        "code": "012025",
        "name": "北海道函館市",
        "kana": "ほっかいどうはこだてし",
        "city_code": "012025",
        "city_name": "函館市",
        "city_kana": "はこだてし",
        "pref_code": "010006",
        "pref_name": "北海道",
        "pref_kana": "ほっかいどう"
    },
// ...
```

### wards.json

```json
[
    {
        "type": "ward",
        "code": "011011",
        "name": "北海道札幌市中央区",
        "kana": "ほっかいどうさっぽろしちゅうおうく",
        "ward_code": "011011",
        "ward_name": "中央区",
        "ward_kana": "ちゅうおうく",
        "city_code": "011002",
        "city_name": "札幌市",
        "city_kana": "さっぽろし",
        "pref_code": "010006",
        "pref_name": "北海道",
        "pref_kana": "ほっかいどう"
    },
    {
        "type": "ward",
        "code": "011029",
        "name": "北海道札幌市北区",
        "kana": "ほっかいどうさっぽろしきたく",
        "ward_code": "011029",
        "ward_name": "北区",
        "ward_kana": "きたく",
        "city_code": "011002",
        "city_name": "札幌市",
        "city_kana": "さっぽろし",
        "pref_code": "010006",
        "pref_name": "北海道",
        "pref_kana": "ほっかいどう"
    },
// ...
```

## Installation

Composerによるインストールが可能です。

```
composer require nojimage/local-gov-code-jp
```
