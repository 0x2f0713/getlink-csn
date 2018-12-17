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
$get = $html->find('a.musictitle',0)->href;
$name = urlencode(preg_replace('/~"#%&*:<>?\{|}. /', ' ', $html->find('a.musictitle',0)->plaintext.' - '.$html->find('div.tenbh',0)->find('p',1)->plaintext));
      $rep  = array(
          'messages' => array(
            0 => array(
                'text' => 'Bài hát: '.urldecode($name)
              ),
          )
      );
echo json_encode($rep);