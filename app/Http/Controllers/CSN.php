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
        $url = strpos($request->input('url'), '_download.html') == 0 ? str_replace('.html', '_download.html', $request->input('url')) : $request->input('url'); // Xử lý cả link download và link nghe nhạc
        $doc = $this->dom->load($url);
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
    public function getAlbum(Request $request)
    {
        $i = 0;
        $data = [];
        $html = $this->dom->load($request->input('url'));
        foreach ($html->find('span.gen') as $d) {
            foreach ($d->find('a[target="_blank"]') as $f) {
                foreach ($d->find('a.musictitle') as $g) {
                    if ($g->text == '') { // Lấy dữ liệu bài hát có chữ đỏ
                        $data[$i]['name'] = $g->find('span')->text;
                        $data[$i]['artists'] = $d->find('span.point')->text;
                    } else { // Lấy dữ liệu bài hát thường
                        $data[$i]['name'] = $g->text;
                        $data[$i]['artists'] = $d->text;
                    };
                }
                $data[$i]['link'] = url("api/csn?url=$f->href");
                $i = $i + 1;
            }
        }
        return json_encode($data);
    }
    public function search(Request $request)
    {
        $data = [];
        $i = 0;
        $page = $request->input('page');
        $category = $request->input('category');
        $mode = $request->input('mode');
        $order = $request->input('order');
        if (empty($page) == true) $page = 1;
        if (empty($category) == true) $category = '';
        if (empty($mode) == true) $mode = '';
        if (empty($order) == true) $order = '';
        if (empty($request->input('category')) == false || empty($request->input('mode')) == false || empty($request->input('order')) == false) {
            $url = 'http://search.chiasenhac.vn/search.php?s=' . urlencode($request->input('s')) . '&mode=' . $mode . '&order=' . $order . '&cat=' . $category . '&page=' . $page;
        } else {
            $url = 'http://search.chiasenhac.vn/search.php?s=' . urlencode($request->input('s')) . '&page=' . $page;
        }
        $html = $this->dom->load($url);
        if ($mode === 'album') {
            foreach ($html->find('span.gen') as $e) { // Lọc dữ liệu tìm kiếm album
                foreach ($e->find('a.musictitle') as $g) {
                    $data[$i]['name'] = $g->innerHtml;
                    $data[$i]['link'] = url("api/csn-album?url=$g->href");
                    $i = $i + 1;
                };
            };
        } else foreach ($html->find('div.tenbh') as $e) { // Lọc dữ liệu bài hát
            foreach ($e->find('p') as $f) {
                foreach ($f->find('a.musictitle') as $g) {
                    $data[$i]['name'] = $g->innerHtml;
                    $data[$i]['link'] = url("api/csn?url=$g->href");
                    $i = $i + 1;
                };
            };
        };
        return json_encode($data);
    }
}