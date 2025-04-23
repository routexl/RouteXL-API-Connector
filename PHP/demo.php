
<?php
$startTime = microtime(true);

//register at RouteXL.com
//10 stops per free account
//100 to 200 stops per paid account

$username = '??????';
$password = '??????';

$baseURL = 'https://api.routexl.com/';
$httpResponseCodes = array(
	'200' => 'OK',
	'401' => 'Authentication problem',
	'403' => 'Too many locations for your subscription',
	'409' => 'No input or no locations found',
	'429' => 'Another route in progress',
	'204' => 'No distance matrix, tour or route was found'
);

if('POST' == $_SERVER['REQUEST_METHOD']){	
	echo '<h2>Results:</h2>';
	if($_POST['type'] == 'status'){
		$url = $baseURL."status/";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		echo 'httpCode: '.$httpCode;
		if($httpCode != 200){
			if(isset($httpResponseCodes[$httpCode])){
				echo ', '.$httpResponseCodes[$httpCode];
			}
		}
		$result = json_decode($result);
		var_dump($result);
	}
	elseif($_POST['type'] == 'distances'){
		$url = $baseURL."distances/";
		$ch = curl_init($url);
		curL_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
		$fields = array('locations'=>$_POST['locations']);
		if($_POST['maxDistance']){
			array_push($fields, $_POST['maxDistance']);
		}
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		echo 'httpCode: '.$httpCode;
		if($httpCode != 200){
			if(isset($httpResponseCodes[$httpCode])){
				echo ', '.$httpResponseCodes[$httpCode];
			}
		}
		$result = json_decode($result);
		var_dump($result);
	}
	elseif($_POST['type'] == 'tour'){
		$url = $baseURL."tour/";
		$ch = curl_init($url);
		curL_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
		$fields = array('locations'=>$_POST['locations']);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$result = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		echo 'httpCode: '.$httpCode;
		if($httpCode != 200){
			if(isset($httpResponseCodes[$httpCode])){
				echo ', '.$httpResponseCodes[$httpCode];
			}
		}
		$result = json_decode($result);
		var_dump($result);
	}
	
	echo '<br>Took: '.number_format(microtime(true)-$startTime, 2).' seconds';
}

	
?>
<hr>
<h1>RouteXL API Test</h1>
<h3>Documentation: https://www.routexl.com/blog/api/?lang=en</h3>
<hr>
<h2>API Status: </h2>
<form method="POST">
<input type="hidden" name="type" value="status">
<input type="submit">
</form>
<hr>

<h2>Distance Matrix:</h2>
<form method="POST">
Locations: <textarea name="locations" style='width: 50%; height: 150px;'>
[{"address":"The Hague, The Netherlands","lat":"52.05429","lng":"4.248618"},{"address":"The Hague, The Netherlands","lat":"52.076892","lng":"4.26975"},{"address":"Uden, The Netherlands","lat":"51.669946","lng":"5.61852"},{"address":"Sint-Oedenrode, The Netherlands","lat":"51.589548","lng":"5.432482"}]
</textarea><br>
Max distance: <input type="number" name="maxDistance" value=""><br>
<input type="hidden" name="type" value="distances">
<input type="submit">
</form>
<hr>

<h2>Tour:</h2>
<form method="POST">
<textarea name="locations" style='width: 50%; height: 150px;'>
[{"address":"The Hague, The Netherlands","lat":"52.05429","lng":"4.248618"},{"address":"The Hague, The Netherlands","lat":"52.076892","lng":"4.26975"},{"address":"Uden, The Netherlands","lat":"51.669946","lng":"5.61852"},{"address":"Sint-Oedenrode, The Netherlands","lat":"51.589548","lng":"5.432482"}]
</textarea><br>
<input type="hidden" name="type" value="tour">
<input type="submit">
</form>
