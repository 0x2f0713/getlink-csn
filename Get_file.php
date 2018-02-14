    <?php
include './simple_html_dom.php';
// Create DOM from URL or file
$url = $_GET[url];
function get_file($url) {
$doc = file_get_html(str_replace('.html', '_download.html', $url));
// Find all links 
#foreach($html->find('a') as $element) 
       #$data = $element->href . '<br>';
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

function get_name($link){;
$html = file_get_html($link);
$filename = preg_replace('/~"#%&*:<>?\{|}. /', ' ', $html->find('h1.viewtitle',0)->plaintext);
#filename = $html->find('h1.viewtitle',0)->plaintext;
  return urlencode($filename);
}

$link = get_file($url)['128kbps'];
$title = get_name($url).'.mp3';
#$id = file_get_contents('http://'. $_SERVER['SERVER_NAME'] .'/post9/upload.php' . '?title=' . $title . '&url=' . $link);
$id = file_get_contents('https://www.namhaiit.ml/php//dropbox.php?url='.$link.'&filename='.$title);

      $rep  = array(
          'messages' => array(
              0 => array(
                  'attachment' => array(
                      'type' => 'audio',
                      'payload' => array(
                          'url' => $id
                      )
                  )
              ),
          )
      );
echo json_encode($rep);