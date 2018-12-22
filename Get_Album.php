    <?php
    include './simple_html_dom.php';
// Create DOM from URL or file
    $i = 0;

    function get_file($url)
    {
        $doc = file_get_html($url);
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
    $html = file_get_html('http://chiasenhac.vn/nghe-album/waiting-for-tomorrow~martin-garrix-pierce-fulton-mike-shinoda~tsvbvdvbqq2m2q.html');
    foreach ($html->find('span') as $d) {
        foreach ($d->find('a[target="_blank"]') as $f) {
            foreach ($d->find('a.musictitle') as $g) {
                $data[$i][name] = $g->plaintext + ' - ' + $d->find('span.point')->text;
            }
            $data[$i][link] = get_file($f->href);
            $i = $i + 1;
        }
    }

    echo json_encode($data);
