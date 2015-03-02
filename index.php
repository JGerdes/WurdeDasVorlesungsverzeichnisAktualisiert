<?php

$url = 'http://www.hs-bremen.de/internet/de/einrichtungen/fakultaeten/f4/service/vorlesungsverzeichnis/';
$base = 'http://www.hs-bremen.de';
$content = file_get_contents($url);
$pattern='/<a href="(\/internet\/einrichtungen\/fakultaeten\/f4\/service\/vorlesungsverzeichnis\/([a-zA-Z0-9_\-\.\(\)\/]*))" title="- Link öffnet sich in einem neuen Fenster" target="_blank">Internationaler Studiengang Medieninformatik B.Sc.<\/a>/';
$result = NULL;

preg_match_all($pattern, $content, $result);

$file = $result[1][0];
$new = $result[2][0] !== '4mi_ws_14_15.pdf';

$splitted = explode('?',$_SERVER["REQUEST_URI"]);
$rss = $splitted[count($splitted)-1] === 'rss';
if($rss){
	header("Content-Type: application/rss+xml");
	echo '<?xml version="1.0" encoding="windows-1252"?>';
?>
<rss version="2.0">
  <channel>
    <title>Wurde das Vorlesungsverzeichnis schon aktualisiert?</title>
    <description>Erfahre, ob das Vorlesungsverzeichnis schon aktualisiert wurde.</description>
    <link>http://wurde-das-vorlesungsverzeichnis-schon-aktualisiert.jonasgerdes.com</link>
    <item>
      <title>Nein</title>
      <description>Bisher gibt es nur den alten Plan</description>
      <link>http://www.hs-bremen.de/internet/einrichtungen/fakultaeten/f4/service/vorlesungsverzeichnis/4mi_ws_14_15.pdf</link>
	</item><?php
	if($new){
		?><item>
	      <title>Ja!</title>
	      <description>Endlich wurde das Vorlesungsverzeichnis aktualisiert!</description>
		  <link><?php echo $base.$file;?></link>
		</item><?php
	}

   ?></channel>
 </rss>
<?php
	}else{
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Wurde das Vorlesungsverzeichnis schon aktualisiert?</title>
		<link href='http://fonts.googleapis.com/css?family=Lobster|Open+Sans:300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="icons.css">
	</head>

	<body>
		<div class="blocker"></div>
		Wurde das Vorlesungsverzeichnis schon aktualisiert?
		<div class="yesno"><?php if($new){
					echo 'Ja!';
				}else{
					echo 'Nein!';
				}?></div>
		<a class="button" href="<?php echo $base.$file;?>" target="_blank"><?php echo ($new ? "Als" : "Alte ")?>PDF-Datei herunterladen</a>
	<div class="ifttt-recipes"></div>
	<footer>
		<div>
			<a class="icon-rss" href="?rss" target="_blank">
				RSS-Feed
			</a>
		</div>
		<div>
			<a class="ifttt">
				IFTTT Rezepte
			</a>
		</div>
		<div>
			Angaben ohne Gew&auml;hr
		</div>
		<div>
			Daten werden geparst vom
			<a class="icon-link" href="http://www.hs-bremen.de/internet/de/einrichtungen/fakultaeten/f4/service/vorlesungsverzeichnis/" target="_blank">
				Vorlesungsverzeichnis der Fakult&auml;t 4 der Hochschule Bremen
			</a>
		</div>
		<div>
			<a class="icon-github" href="https://github.com/JGerdes/WurdeDasVorlesungsverzeichnisAktualisiert" target="_blank">
				Source auf GitHub
			</a>
		</div>
	</footer>
	<script type="text/javascript" src="script.js"></script>
	</body>
</html>
<?php
	}
?>