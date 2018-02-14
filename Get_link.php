<?php
include './simple_html_dom.php';
// Create DOM from URL or file
$i = 0;
$page = $_GET[page];
$category = $_GET[category];
$mode = $_GET[mode];
$order = $_GET[order];
if (empty($page) == true) $page = 1;
if (empty($category) == true) $category = '';
if (empty($mode) == true) $mode = '';
if (empty($order) == true) $order = '';
if (empty($_GET[category]) == false || empty($_GET[mode]) == false  || empty($_GET[order]) == false) {
    $url = 'http://search.chiasenhac.vn/search.php?s='.urlencode($_GET[data]).'&mode='.$mode.'&order='.$order.'&cat='.$category.'&page='.$page;
} else {
    $url = 'http://search.chiasenhac.vn/search.php?s='.urlencode($_GET[data]).'&page='.$page;
}
$html = file_get_html($url);
foreach ($html->find('div.tenbh') as $e) {
    foreach ($e->find('p') as $f) {
        foreach ($f->find('a.musictitle') as $g) {
            $data[$i][name] = $g->plaintext;
            $data[$i][link] = get_file($g->href);
            $i = $i +1;
        };
    };
};

function get_file($url) {
$doc = file_get_html(str_replace('.html', '_download.html', $url));

foreach ($doc->find('div#downloadlink2') as $e) {
    foreach ($e->find('b') as $f) {
        foreach ($f->find('a') as $g) {
            foreach ($g->find('span') as $h) {
                $data[preg_replace('/ /', '', $h->plaintext)] = $g->href;
            };
        };
    };
};
return $data;
}

echo json_encode($data);