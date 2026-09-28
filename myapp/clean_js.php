<?php
$dir = 'c:\xampp\htdocs\e-commercewebsite\myapp\resources\views';
$files = glob($dir . '/*.blade.php');
$files = array_merge($files, glob($dir . '/admin/*.blade.php'));

foreach ($files as $file) {
    $content = file_get_contents($file);
    
    // Remove $.get for navbar and footer
    $content = preg_replace('/\$\.get\([\'"]components\/(navbar|footer)\.html[\'"],\s*function\(data\)\s*\{\s*\$\([\'"]#(navbar|footer)-placeholder[\'"]\)\.html\(data\);\s*\}\);/is', '', $content);
    // There might also be $(document).ready(...) that is now empty or contains it
    file_put_contents($file, $content);
}
echo "Cleaned JS.";
