<?php

// Get the request
$request = ! empty( $_SERVER['REQUEST_URI'] ) ? preg_replace( '/^\//i', '', $_SERVER['REQUEST_URI'] ) : '';

// Sanitize the string
$request = filter_var( $request, FILTER_SANITIZE_STRING );
	
// Create the headers
header( 'Link: https://hiroy.club' );
header( 'Hi: Roy' );

// Are we looking for audio?
if ( preg_match( '/^audio\/?/i', $request ) ) {
	
	// Define the available audio files
	$audio_files = array(
		'carl'		=> 'hi-roy-carl.mp3',
		'chris'		=> 'hi-roy-chris.mp3',
		'curtiss'	=> 'hi-roy-curtiss.mp3',
		'kate'		=> 'hi-roy-kate.mp3',
		'michal1'	=> 'hi-roy-mb-1.mp3',
		'michal2'	=> 'hi-roy-mb-2.mp3',
		'michal3'	=> 'hi-roy-mb-3.mp3',
		'michal4'	=> 'hi-roy-mb-4.mp3',
		'michal5'	=> 'hi-roy-mb-5.mp3',
		'shawn'		=> 'hi-roy-shawn.mp3',
		'shelly'	=> 'hi-roy-shelly.mp3',
	);
	
	// Define the audio file
	$audio_file = '';
	
	// Did the user define who "from"?
	$from = ! empty( $_REQUEST['from'] ) ? strtolower( $_REQUEST['from'] ) : '';
	if ( ! empty( $from ) ) {
		switch( $from ) {
			
			// Michael has 5 audio files so pick one at random
			case 'michal':
				$rand_index = rand( 1, 5 );
				if ( ! empty( $audio_files[ "michal{$rand_index}" ] ) ) {
					$audio_file = $audio_files[ "michal{$rand_index}" ];
				}
				break;
			
			default:
			
				// Select the "from" audio file
				if ( ! empty( $audio_files[ $_REQUEST['from'] ] ) ) {
					$audio_file = $audio_files[ $_REQUEST['from'] ];
				}
				break;
			
		}
	}
	
	// If no audio file, pick one at random
	if ( empty( $audio_file ) ) {
		$audio_file = $audio_files[ array_rand( $audio_files ) ];		
	}
	
	// If still empty, Hi Carl
	if ( empty( $audio_file ) ) {
		$audio_file = 'hi-roy-carl.mp3';
	}
	
	// Get the audio file
	$audio_file_path = "audio/{$audio_file}";
	if ( file_exists( $audio_file_path ) ) {
	
		// Set the headers
		header( 'Content-Type: audio/mpeg' );
		header( 'Content-Disposition: inline;filename="' . $audio_file . '"' );
		header( 'Content-length: ' . filesize( $audio_file_path ) );
	    //header( 'Cache-Control: no-cache' );
	    header( 'Content-Transfer-Encoding: chunked' );
	    readfile( $audio_file_path );
	    exit;
		
	}
	
	header( 'HTTP/1.0 404 Not Found' );
	exit;
	
}

// Are we saying hi to anyone in particular?
if ( preg_match( '/^hi\/([a-z\-\'\"]+)/i', $request, $matches ) ) {
	if ( ! empty( $matches[1] ) ) {
		
		// Get the name
		if ( $name = ucfirst( $matches[1] ) ) {
			header( 'Content-Type: text/html' );
			echo "Hi {$name}";
			exit;
		}
		
	}
}

// Hi Roy
header( 'Content-Type: text/html' );
echo 'Hi Roy';
exit;