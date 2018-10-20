#!/usr/bin/php
<?php
// preg_match

$nb = preg_match('/toto/', 'foototobartotobaz');
echo "$nb \n";
// all continue dans la chaine
$nb = preg_match_all('/toto/', 'foototobartotobaz');
echo "$nb \n";

$nb = preg_match('/^toto$$/', 'toto');
echo "$nb \n";

// toto titi + * ?: 0 ou 1 {4}: 4 excatement
// [^0-9]: tout sauf les chiffres
$nb = preg_match('/t[oi]t[oi]/', 'titi');
echo " toto titi: $nb \n";

echo " ========================== \n";
//\1 contient le match de la premiere ()
$str = "toti";
$nb = preg_match("/t([io])t\1/", "toti", $matches);
echo " $str \1 marche ?? : $nb \n";
echo " ========================== \n";
print_r($matches);


$nb = preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
//print_r($matches);

// variable variable
echo "$key\n";

$nom = "key";

$$nom = "val";

echo "$key\n";

//====== fucichier 
//file() tout dans un tab
//file_get-contents() tout dans une str
$tab = file("data.csv");
foreach( $tab as $elt) {
	echo "$elt\n";
}
//fopen() : envoie un handler
//a utiliser conjointement avec fread() fwrite() fclose()
//ce sont des bindings des appels systemes en C


//fgets() a besoin de fopen() pour fonctionner
$fhandle = fopen("data.csv", "r");
while($line = fgets($fhandle)) {
	echo "$line";
}
fclose($fhandle);

//fgetcsv(): recupere contenu du fichier ligne par ligne et le decoupe sachant que c est un fichier csv
$fhandle = fopen("data.csv", "r");
while($tab = fgetcsv($fhandle, 0, ";")) {
	print_r($tab);
}
fclose($fhandle);

//eval() prend du code php et l evalue - ATTENTION dangereux
//eval("echo 'Hello World';");

//=== : = et de meme type
if(0 == "World") {
	echo "OK\n";
} else {
	echo "NOT OK\n";
}

if(0 === "World") {
	echo "OK\n";
} else {
	echo "NOT OK\n";
}

$my_tab = array("zero", "un", "deux");

$str = "un";
if(array_search($str, $my_tab) !== FALSE) {
	echo "$str found\n";
} else {
	echo "$str not found\n";
}

$str = "zero";
if(array_search($str, $my_tab) !== FALSE) {
	echo "$str found\n";
} else {
	echo "$str not found\n";
}

// curl_init() on transmet une adresse url
// create a new cURL resource
$ch = curl_init("http://www.42.fr");
// grab URL and pass it to the browser
$str = curl_exec($ch);
echo $str;

// close cURL resource, and free up system resources
curl_close($ch);


?>
