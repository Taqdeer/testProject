<?php
if(!empty($_GET['countryName'])){
	$maps= 'http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($_GET['countryName']);
	$json= file_get_contents($maps);
	$array= json_decode($json,true); //value set to true so to make it an array and not object
	$lat= $array['results'][0]['geometry']['location']['lat'];
	$lng= $array['results'][0]['geometry']['location']['lng'];
	$instaLocations= 'https://api.instagram.com/v1/locations/search?lat='.$lat.'&lng='.$lng.'&access_token=5812537533.d0910af.81824642c3794358a9bd52683fd07671';
	$instaJSON= file_get_contents($instaLocations);
	$instaArray= json_decode($instaJSON, true);
}

?>
<html>
	<head>
	<title>Testing</title>
	</head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<body>
	<div class="background">
	<form action="">
	
		<div class="container">
		<h1> My INSTA Search Engine </h1>
		<div class="getField">
			<input type="text" id="countryName" name="countryName"/>
			<button type="submit"><span class="glyphicon glyphicon-search"></span>Search</button>
		</div>
		<br>
		<br>
		
		<?php
		if(!empty($instaArray)){
			echo "<h2 style='text-align: center; color: hsla(560,100%,15%,0.3); font-family: Comic Sans MS'>
			Recent pictures at Insta are from following places : )<br></h2>";
			echo "<ul style='list-style-type:none; text-align: center; color: hsla(0, 100%, 30%, 0.9); font-family: Comic Sans MS'>";
			foreach($instaArray['data'] as $img){
				echo "<li style='text-align: center;>".$img['name']."</li>";
			}
			echo "</ul>";
		}
		?>
		
		</div>
		</div>
	</form>
	</body>
</html>