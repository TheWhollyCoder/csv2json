<?php
$path = './';
$file_name = 'test-file.html';
$url = $path.$file_name;
$content = '<h1>The WhollyCoder</h1>';

file_put_contents($url, $content);
 ?>
