<?php
$listFile = 'https://pastebin.com/raw/mqCJTET3'; 
$listContent = file_get_contents($listFile);

if ($listContent === false) {
    header('Content-Type: text/plain; charset=utf-8');
    echo "Gagal mengambil data dari URL.";
    exit;
}


$posts = explode(PHP_EOL, trim($listContent));
$pages = [];

foreach ($posts as $post) {
    $url = 'https://stikespanritahusada.ac.id/?post=' . trim($post);
    $pages[] = [
        'loc' => $url,
        'lastmod' => date('Y-m-d'),
        'priority' => '1.0' 
    ];
}

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($pages as $page): ?>
        <url>
            <loc><?php echo htmlspecialchars($page['loc']); ?></loc>
            <lastmod><?php echo htmlspecialchars($page['lastmod']); ?></lastmod>
            <priority><?php echo htmlspecialchars($page['priority']); ?></priority>
        </url>
    <?php endforeach; ?>
</urlset>
