<?php

// Get the request
$request = ! empty( $_SERVER['REQUEST_URI'] ) ? preg_replace( '/^\//i', '', $_SERVER['REQUEST_URI'] ) : '';

// Sanitize the string
$request = filter_var( $request, FILTER_SANITIZE_STRING );
	
// Create the headers
header( 'Content-Type: text/html' );
header( 'Link: https://hiroy.club' );
header( 'Hi: Roy' );

// Are we saying hi to anyone in particular?
if ( preg_match( '/hi\/([a-z\-\'\"]+)/i', $request, $matches ) ) {
	if ( ! empty( $matches[1] ) ) {
		
		// Get the name
		if ( $name = ucfirst( $matches[1] ) ) {
			echo "Hi {$name}";
			exit;
		}
		
	}
}

// Hi Roy
echo 'Hi Roy';
exit;