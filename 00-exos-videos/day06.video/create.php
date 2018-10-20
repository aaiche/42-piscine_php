<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

Class Exemple_methode_statique {
	//
	// Les attributs et les methodes NE SONT PAS FORCEMENT liees a une INSTANCE
	// et peuvent etre utilisees au niveau de la CLASSE: on parlera dans ce cas de:
	// 		- attributs ou methodes statiques
	// Une methode statique est une methode qui EXISTE au NIVEAU de la CLASSE et qui N EST dans AUCUNE INSTANCE: 
	// elles sont dans le scope de la classe et PEUVENT ETRE UTILISEES par N IMPORTE QUELLE INSTANCE. ET
	// PEUVENT etre utilisees SANS INSTANCE ==> et c est leur INTERET . 
	//  ==> la syntaxe : on ajoute 'static' devant la fonction
	//  ATTENTION: dans une methode statique: il N  Y PAS de variable THIS. CAR ELLE EXISTE que dans le cadre de la classe
	//  et PAS dans L INSTANCE. Cela vaut dire aussi que cette methode est partagee par ttes les instances et
	//  pourra etre utilise par n importe quelle instance
	//
	
	// doc() est la meme pour ttes les instances d ou le nom statique
	// on peut lui faire des args
	public static function doc() {
		//self:: ==> OUI
		//this:: ==> NON
		return 'This is a sample class with no real purpose.';
	}

	public function __construct() {
		print( 'Constructor called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}
}


// Il n y a aucune instance
print( 'Exemple doc: ' . Exemple_methode_statique::doc() . PHP_EOL );

?>
