<?php

/* RouteXL API Connector
 * 
 */

namespace RouteXL;

class API_Connector {
	
	var
		$result = array(),
		$http_code = 0,
		$error = ''
	;

	function tour($locations) {
		 	
		try {
			
			// Use libcurl to connect and communicate
			$ch = curl_init(); // Initialize a cURL session
			curl_setopt($ch, CURLOPT_URL, 'https://api.routexl.nl/tour'); // Set the URL
			curl_setopt($ch, CURLOPT_HEADER, 0); // No header in the output
			curl_setopt($ch, CURLOPT_POST, 1); // Do a regular HTTP POST
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'locations=' . json_encode($locations)); // Add the locations
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the output as a string
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate'); // Compress
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); // Basic authorization
			curl_setopt($ch, CURLOPT_USERPWD, 'xxx:xxx'); // Your credentials username:password
			
			// Do not use this
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Unsafe!
			
			// Execute
			$output = curl_exec($ch); // Execute the curl command, get the output
			$this->http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Last received HTTP code
			$this->error = curl_error($ch); // Return the last error
			curl_close($ch); // Close the connection
			
			$this->result = json_decode($output);
			
		} catch(exception $e) {
			
			$this->error = $e->getMessage();
			return false;
			
		} 
		
		if ($this->http_code!=200) return false; 
		else return true;
		
	}
	
};
