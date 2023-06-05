<?php
require_once(__DIR__ . '/bootstrap.php');

/**
 * データダウンロード
 */
$client = new \Symfony\Component\BrowserKit\HttpBrowser();
$downloadPage = $client->request('GET', DOWNLOAD_PAGE);

$link = $downloadPage->selectLink(DOWNLOAD_LINK_TEXT)->link();
$excelFile = $client->click($link);

file_put_contents(DOWNLOAD_FILE, $client->getInternalResponse()->getContent());
