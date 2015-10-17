<?php

if (isset($_POST['source'])) {
 
    $source = $_POST['source'];

    $filename = basename($source);

    file_put_contents($filename, fopen($source, 'r'));
}