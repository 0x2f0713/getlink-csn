    <?php
include './simple_html_dom.php';

$url = $_GET[url];

function get_file($url) {
$doc = file_get_html(str_replace('.html', '_download.html', $url));
foreach ($doc->find('div#downloadlink2') as $e) {
    foreach ($e->find('b') as $f) {
        foreach ($f->find('a') as $g) {
            foreach ($g->find('span') as $h) {
                $data[preg_replace('/ /', '', $h->plaintext)] = preg_replace('/ /', '', $g->href);
            };
        };
    };
};
return $data;
}

// Có thể sử dụng tùy bạn
function get_name($link){;
$html = file_get_html($link);
$filename = preg_replace('/~"#%&*:<>?\{|}. /', ' ', $html->find('h1.viewtitle',0)->plaintext);
  return $filename;
}

$link = get_file($url);

echo json_encode($link);
