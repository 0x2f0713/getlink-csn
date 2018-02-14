<?php 
require "vendor/autoload.php";
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxFile;

$app = new DropboxApp("jb24om313hf1s45", "ht5y8qv7qtwte5l", 'MFF4oiIi1aAAAAAAAAAAwyG9Q8Wa4xxTaFMNlzlIV4MJVObK-V2DxLkMLIsrpXav');
$dropbox = new Dropbox($app);
$dropboxFile = new DropboxFile($_GET[url]);
$file = $dropbox->simpleUpload($dropboxFile, "/".$_GET[filename], ['autorename' => false]);
$temporaryLink = $dropbox->getTemporaryLink("/".$_GET[filename]);

//Get File Metadata
//$file = $temporaryLink->getMetadata();

//Get Link
//$temporaryLink->getLink();
echo $temporaryLink->link;
 ?>