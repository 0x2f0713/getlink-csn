<?php
include './simple_html_dom.php';
require "vendor/autoload.php";
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxFile;

$html = file_get_html('http://search.chiasenhac.vn/search.php?s='.urlencode($_GET[data]));
$get = $html->find('a.musictitle',0)->href;
$name = preg_replace('/~"#%&*:<>?\{|}. /', ' ', $html->find('a.musictitle',0)->plaintext.' - '.$html->find('div.tenbh',0)->find('p',1)->plaintext);

function get_file($url) {
    $doc = file_get_html(str_replace('.html', '_download.html', $url));
    $data = $doc->find('div#downloadlink2',0)->find('b',1)->find('a',0)->href;
    return $data;
}

$app = new DropboxApp("jb24om313hf1s45", "ht5y8qv7qtwte5l", 'MFF4oiIi1aAAAAAAAAAAwyG9Q8Wa4xxTaFMNlzlIV4MJVObK-V2DxLkMLIsrpXav');
$dropbox = new Dropbox($app);
$dropboxFile = new DropboxFile(get_file($get));
$file = $dropbox->simpleUpload($dropboxFile, "/".$name.'.mp3', ['autorename' => false]);
$temporaryLink = $dropbox->getTemporaryLink("/".$name.'.mp3');

//Get File Metadata
$file = $temporaryLink->link;



      $rep  = array(
          'messages' => array(
            0 => array(
                  'attachment' => array(
                      'type' => 'audio',
                      'payload' => array(
                          'url' => $file
                      )
                  )
              ),
            )
          );
echo json_encode($rep);