<?php

	include('CalFileParser-master/CalFileParser.php');

	$cal = new CalFileParser();
	
	$service_url = 'http://coobomedia.com/webdav/server.php/home/clint/My%20Test%20Calendar.ics';

	$data = $cal->parse($service_url,'json');
	
	echo $data;


?>
/*$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $file);
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
			curl_setopt($curl, CURLOPT_USERPWD, "clint:clintz123"); //Your credentials goes here
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($curl, CURLOPT_USERAGENT, 'PHP/'.PHP_VERSION);
			curl_setopt($curl, CURLOPT_ENCODING, '');
			if( strstr( $file, 'https' ) !== FALSE ) {
				curl_setopt($curl, CURLOPT_SSLVERSION, 3);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
			}
			curl_setopt($curl, CURLOPT_COOKIESESSION, true);
			curl_setopt($curl, CURLOPT_HEADER, true);
			if( !ini_get('safe_mode') ){
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			}
			$data = curl_exec($curl);
			curl_close($curl);*/

http://user:password@www.website.example/therestof/yourcalendarurl