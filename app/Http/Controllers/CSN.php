<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPHtmlParser\Dom;

class CSN extends Controller
{
    public function __construct()
    {
        $this->dom = new Dom;
    }
    public function getDownloadLinks(Request $request)
    {
        $doc = $this->dom->load(str_replace('.html', '_download.html', $request->input('url')));
        foreach ($doc->find('div#downloadlink2') as $e) {
            foreach ($e->find('b') as $f) {
                foreach ($f->find('a') as $g) {
                    foreach ($g->find('span') as $h) {
                        $data[preg_replace('/ /', '', $h->innerHtml)] = preg_replace('/ /', '', $g->href);
                    };
                };
            };
        };
        return json_encode($data);
    }
}