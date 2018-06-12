# Local government codes in Japan

総務省の提供する全国地方公共団体コードをJSON化したものです。

都道府県コード及び市区町村コード（平成28年10月10日現在）をベースに作成しています。

- prefectures.json 都道府県コード
- cities.json 市区町村コード
- wards.json 政令指定都市の区コード
- jp_local_gov_codes.mysql.sql MySQL用テーブル定義＋データ

を提供します。

## Installation

Composerによるインストールが可能です。

```
composer require nojimage/local-gov-code-jp
```
