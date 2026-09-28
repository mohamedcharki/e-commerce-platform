<?php
$dir = 'c:\xampp\htdocs\e-commercewebsite\myapp\resources\views';
$files = glob($dir . '/*.blade.php');
$files = array_merge($files, glob($dir . '/admin/*.blade.php'));

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Replace navbar
    $content = preg_replace('/<div id="navbar-placeholder"><\/div>/', '@include(\'components.navbar\')', $content);
    // Replace footer
    $content = preg_replace('/<div id="footer-placeholder"><\/div>/', '@include(\'components.footer\')', $content);
    
    // Replace href="assets/..."
    $content = preg_replace('/href="assets\/([^"]+)"/', 'href="{{ asset(\'assets/$1\') }}"', $content);
    // Replace src="assets/..."
    $content = preg_replace('/src="assets\/([^"]+)"/', 'src="{{ asset(\'assets/$1\') }}"', $content);
    
    // Admin specific replacements
    $content = preg_replace('/href="\.\.\/assets\/([^"]+)"/', 'href="{{ asset(\'assets/$1\') }}"', $content);
    $content = preg_replace('/src="\.\.\/assets\/([^"]+)"/', 'src="{{ asset(\'assets/$1\') }}"', $content);

    // Some pages might just have href="admin/assets/..." or src="admin/assets/..." wait no, admin pages had href="assets/css..." because they were in /admin/
    // Let's also do:
    if (strpos($file, 'admin\\') !== false || strpos($file, 'admin/') !== false) {
        $content = preg_replace('/href="assets\/([^"]+)"/', 'href="{{ asset(\'admin/assets/$1\') }}"', $content);
        $content = preg_replace('/src="assets\/([^"]+)"/', 'src="{{ asset(\'admin/assets/$1\') }}"', $content);
    }
    
    file_put_contents($file, $content);
}
echo "Template replacements done.";
