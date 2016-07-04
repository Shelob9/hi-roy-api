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
		'carl'		=> array(
			'audio' => array(
				'hi-roy-carl.mp3',
			),
		),
		'chris'		=> array(
			'audio' => array(
				'hi-roy-chris.mp3',
			),
		),
		'curtiss'	=> array(
			'audio' => array(
				'hi-roy-curtiss.mp3',
			),
		),
		'kate'		=> array(
			'audio' => array(
				'hi-roy-kate.mp3',
			),
		),
		'meagan'	=> array(
			'audio' => array(
				'hi-roy-meagan-1.mp3',
				'hi-roy-meagan-2.mp3',
				'hi-roy-meagan-3.mp3',
				'hi-roy-meagan-4.mp3',
			),
		),
		'michal'	=> array(
			'audio' => array(
				'hi-roy-mb-1.mp3',
				'hi-roy-mb-2.mp3',
				'hi-roy-mb-3.mp3',
				'hi-roy-mb-4.mp3',
				'hi-roy-mb-5.mp3',
			),
		),
		'shawn'		=> array(
			'audio' => array(
				'hi-roy-shawn.mp3',
			),
		),
		'shelly'	=> array(
			'audio' => array(
				'hi-roy-shelly.mp3',
			),
		),
	);
	
	// Define the audio file
	$audio_file = '';
	
	// Did the user define who "from"?
	$from = ! empty( $_REQUEST['from'] ) ? strtolower( $_REQUEST['from'] ) : '';
	
	// Find the name and optional index
	preg_match( '/^([^0-9]+)([0-9]*)?/i', $from, $from_matches );
	
	// Get the "from" name
	$from_name = ! empty( $from_matches[1] ) ? $from_matches[1] : '';
	
	// Get the optional "from" index
	$from_index = ! empty( $from_matches[2] ) ? $from_matches[2] : '';
	
	// If we have a "from" name
	if ( ! empty( $from_name ) ) {
		
		// Convert "from" Twitter handle to handle
		switch ( $from_name ) {
			
			case 'twigpress':
				$from_name = 'carl';
				break;
				
			case 'chrisflanny':
				$from_name = 'chris';
				break;
				
			case 'cgrymala':
				$from_name = 'curtiss';
				break;
				
			case '2fishweb':
				$from_name = 'kate';
				break;
				
			case 'mhanes':
				$from_name = 'meagan';
				break;
				
			case 'isotrope':
				$from_name = 'michal';
				break;
				
			case 'shawnhooper':
				$from_name = 'shawn';
				break;
				
			case 'spinbird':
				$from_name = 'shelly';
				break;
			
		}
		
		// If this person has audio files...
		if ( ! empty( $audio_files[ $from_name ]['audio'] ) ) {
			
			// If we have a defined index and the index exists...
			if ( $from_index > 0 ) {
				
				// Subtract 1 to align with array index
				$from_index--;
				
				// Get the specified file
				if ( ! empty( $audio_files[ $from_name ]['audio'][ $from_index ] ) ) {
					$audio_file = $audio_files[ $from_name ]['audio'][ $from_index ];
				}
				
			}
			
			// Otherwise pick a file at random
			if ( ! $audio_file ) {
				$audio_file = $audio_files[ $from_name ]['audio'][ array_rand( $audio_files[ $from_name ]['audio'] ) ];
			}
			
		}
		
	}
	
	// If no audio file, pick one at random
	if ( ! $audio_file ) {
		
		// Get random person
		$random_person = array_rand( $audio_files );
		
		// Pick a random audio file from that person
		if ( ! empty( $audio_files[ $random_person ]['audio'] ) ) {
			$audio_file = $audio_files[ $random_person ]['audio'][ array_rand( $audio_files[ $random_person ]['audio'] ) ];
		}
		
	}
	
	// If still empty, Hi Carl
	if ( ! $audio_file ) {
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