<?php
// Test de la classe RSS
require_once('RSS.class.php');
require_once('Nouvelles.class.php');

// Une instance de RSS
$rss = new RSS('http://www.lemonde.fr/m-actu/rss_full.xml');

// Affiche le titre
echo $rss->titre()."\n";
echo "dernière mise à jour le : ".$rss->date()."\n";

$it=0;
echo "<html>";
echo "<head><title>RSS</title>";
echo "<style>td {border : 1px solid black; padding : 5px;} table {border-collapse : collapse;} img {width : 30%; height : 30%;}</style></head>";
echo "<body>";

foreach ($rss->nouvelles() as $node) {

	//if ($it<4) {
		$nouvelle = new Nouvelles;
		$nouvelle->update($node);
		echo "<table>";
		echo "<tr><th>".$nouvelle->titre()."</th></tr>";
		echo "<tr><td>".$nouvelle->pubDate()."</td></tr>";
		echo "<tr><td>".$nouvelle->description()."</td></tr>";
		echo "<tr><td>".$nouvelle->lien()."</td></tr>";
		echo '</table><img src="'.$nouvelle->image().'">';
	//}
	//$it++;
}
echo "</body></html>";
?>