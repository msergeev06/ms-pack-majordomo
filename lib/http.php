<?php

namespace MSergeev\Packages\Majordomo\Lib;

use MSergeev\Core\Lib as CoreLib;

class Http
{
	public static function checkAutorize ()
	{
		//TODO: Добавить возможность авторизовываться различным пользователям под различными паролями

		include_once(CoreLib\Config::getConfig('DOCUMENT_ROOT').'config.php');
		if (defined('HOME_NETWORK') && HOME_NETWORK != '' && !isset($argv[0])
			&& (!(preg_match('/\/gps\.php/is', $_SERVER['REQUEST_URI'])
					|| preg_match('/\/trackme\.php/is', $_SERVER['REQUEST_URI'])
					|| preg_match('/\/btraced\.php/is', $_SERVER['REQUEST_URI']))
				|| $_REQUEST['op'] != '')
			&& !preg_match('/\/rss\.php/is', $_SERVER['REQUEST_URI'])
			&& 1)
		{
			$p = preg_quote(HOME_NETWORK);
			$p = str_replace('\*', '\d+?', $p);
			$p = str_replace(',', ' ', $p);
			$p = str_replace('  ', ' ', $p);
			$p = str_replace(' ', '|', $p);

			$remoteAddr = getenv('HTTP_X_FORWARDED_FOR') ? getenv('HTTP_X_FORWARDED_FOR') : $_SERVER["REMOTE_ADDR"];

			if (!preg_match('/' . $p . '/is', $remoteAddr) && $remoteAddr != '127.0.0.1')
			{
				// password required
				//echo "password required for ".$remoteAddr;exit;
				//DebMes("checking access for ".$remoteAddr);

				if (!isset($_SERVER['PHP_AUTH_USER']))
				{
					header("WWW-Authenticate: Basic realm=\"" . PROJECT_TITLE . "\"");
					header("HTTP/1.0 401 Unauthorized");
					echo "Authorization required\n";
					exit;
				}
				else
				{
					if ($_SERVER['PHP_AUTH_USER'] != EXT_ACCESS_USERNAME || $_SERVER['PHP_AUTH_PW'] != EXT_ACCESS_PASSWORD)
					{
						// header("Location:$PHP_SELF\n\n");
						header("WWW-Authenticate: Basic realm=\"" . PROJECT_TITLE . "\"");
						header("HTTP/1.0 401 Unauthorized");
						echo "Authorization required\n";
						exit;
					}
				}
			}
		}
	}
}