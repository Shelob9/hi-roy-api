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
	
	// Define the default audio file
	$audio_file = 'hi-roy-carl.mp3';
	
	// Did the user define who "from"?
	$from = ! empty( $_REQUEST['from'] ) ? $_REQUEST['from'] : '';
	if ( ! empty( $from ) ) {
		switch( $from ) {
			
			case 'chris':
				$audio_file = 'hi-roy-chris-f.m4a';
				break;
				
			case 'curtiss':
				$audio_file = 'hi-roy-curtiss.mp3';
				break;
			
			case 'kate':
				$audio_file = 'hi-roy-kate.m4a';
				break;
				
			// Michael has 5 audio files so pick one at random
			case 'michal':
				$audio_file = 'hi-roy-mb-' . rand( 1, 5 ) . '.mp3';
				break;
				
			case 'shawn':
				$audio_file = 'hi-roy-shawn.mp4';
				break;
				
			case 'shelly':
				$audio_file = 'hi-roy-shelly.m4a';
				break;
				
			// Carl is the default
			case 'carl':
			default:
				$audio_file = 'hi-roy-carl.mp3';
				break;
			
		}
	}
	
	// Get the audio file
	if ( ! empty( $audio_file ) ) {
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