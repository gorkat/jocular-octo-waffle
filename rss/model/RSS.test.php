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

foreach ($rss->nouvelles() as $node) {

	if ($it<1) {
		$nouvelle = new Nouvelles;
		$nouvelle->update($node);
/*		echo "\n".$nouvelle->titre()."\n";
		echo $nouvelle->pubDate()."\n";;
		echo $nouvelle->description()."\n";
		echo $nouvelle->lien()."\n";
		echo $nouvelle->id()."\n";
*/
	}
	$it++;
}

?>