<?php
require 'waggo.php';

function notfound()
{
	http_response_code( 404 );
	exit();
}

if ( ! $path = $_GET['_'] ?? null )
{
	notfound();
}

if ( ! $location = WGPluginVite::location( $path ) )
{
	notfound();
}

wg_location( $location );
