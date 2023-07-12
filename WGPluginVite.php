<?php
require_once 'waggo.php';

class WGPluginVite
{
	const VITE_PORT = 5173;

	static public function manifest()
	{
		/** @var array | null */
		static $manifest;

		if ( $manifest )
		{
			return $manifest;
		}

		$manifest = null;
		$path = WGCONF_DIR_PUB . '/assets/manifest.json';

		if ( file_exists( $path ) )
		{
			$manifest = json_decode( file_get_contents( $path ), true );
		}

		return $manifest;
	}

	static public function location(string $path)
	{
		if ( ! $manifest = self::manifest() )
		{
			$baseUrl = self::viteBaseUrl();

			return "{$baseUrl}/{$path}";
		}

		$fpath = $manifest[$path]['file'] ?? null;

		if ( ! $fpath || ! file_exists( WGCONF_DIR_PUB . "/assets/{$fpath}" ) )
		{
			return null;
		}

		return WGCONF_URLBASE . "/assets/{$fpath}";
	}

	static public function client()
	{
		if ( self::manifest() )
		{
			return '';
		}

		$baseUrl = self::viteBaseUrl();

		return "<script type='module' src='{$baseUrl}/@vite/client'></script>";
	}

	static private function viteBaseUrl()
	{
		$host     = preg_replace( '/:\d+$/', '', $_SERVER['HTTP_HOST'] );
		$baseUrl  = sprintf( '//%s:%s', $host, self::VITE_PORT );

		return $baseUrl;
	}
}
