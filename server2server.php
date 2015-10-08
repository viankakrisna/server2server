<?php

if (isset($_POST['source'])) {
 
    $source = $_POST['source'];

    $filename = basename($source);

    set_time_limit(0);
    file_put_contents( 'progress.txt', '' );
    $targetFile = fopen( $filename, 'w' );
    $ch = curl_init( $source );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt( $ch, CURLOPT_NOPROGRESS, false );
    curl_setopt( $ch, CURLOPT_PROGRESSFUNCTION, 'progressCallback' );
    curl_setopt( $ch, CURLOPT_FILE, $targetFile );
    curl_exec( $ch );
    fclose( $targetFile );
}

static $prevProgress = 0;

function progressCallback( $id, $download_size, $downloaded_size, $upload_size, $uploaded_size ){

    if ( $download_size == 0 ){

        $progress = 0;

    } else {

        $progress = round( $downloaded_size / $download_size ) * 100;
    
    }
    // if ($prevProgress < $progress < 100){
    // }
    file_put_contents('progress.txt', $downloaded_size);
}