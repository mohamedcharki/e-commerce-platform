<?php

$urls = [
    // White/Black Dresses
    'https://images.unsplash.com/photo-1515347619362-6725e2db8129',
    'https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d',
    'https://images.unsplash.com/photo-1495385794356-15371f348c31',
    'https://images.unsplash.com/photo-1585487000160-6ebcfceb0d03',

    // Red/Blue Dresses
    'https://images.unsplash.com/photo-1539008835657-9e8e9680c956',
    'https://images.unsplash.com/photo-1572804013309-8c98e10f1484',

    // Floral Dresses
    'https://images.unsplash.com/photo-1595777457583-95e059d581b8',
    'https://images.unsplash.com/photo-1496747611176-843222e1e57c',

    // Shirts/Tops
    'https://images.unsplash.com/photo-1598554747436-c9293d6a588f',
    'https://images.unsplash.com/photo-1598554747209-6617fcbd42da',
    'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c',
    'https://images.unsplash.com/photo-1550614000-4b95dd2458bd',

    // Skirts
    'https://images.unsplash.com/photo-1582142407894-ec85a1260a46',
    'https://images.unsplash.com/photo-1582142306909-195724d33ffc',
    'https://images.unsplash.com/photo-1583337130417-3346a1be7dee',
    'https://images.unsplash.com/photo-1552874869-5c39ec9288dc',

    // Jackets/Coats
    'https://images.unsplash.com/photo-1591047139829-d91aecb6caea',
    'https://images.unsplash.com/photo-1534653299134-96a171b61581',
    'https://images.unsplash.com/photo-1539533018447-63fcce2678e3',
    'https://images.unsplash.com/photo-1544022613-e87ca75a3c4a',

    // Extra fashion images
    'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f',
    'https://images.unsplash.com/photo-1483985988355-763728e1935b',
    'https://images.unsplash.com/photo-1490481651871-ab68de25d43d',
    'https://images.unsplash.com/photo-1532453288672-3a27e9be9efd',
    'https://images.unsplash.com/photo-1485230405346-71acb9518d9c',
    'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f',
    'https://images.unsplash.com/photo-1543163521-1bf539c55dd2'
];

$valid_urls = [];
foreach ($urls as $url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode >= 200 && $httpCode < 400) {
        $valid_urls[] = $url . '?auto=format&fit=crop&q=80&w=800';
    } else {
        echo "Failed: $url\n";
    }
}

file_put_contents('valid_images.json', json_encode($valid_urls, JSON_PRETTY_PRINT));
echo "Found " . count($valid_urls) . " valid URLs.\n";

?>
