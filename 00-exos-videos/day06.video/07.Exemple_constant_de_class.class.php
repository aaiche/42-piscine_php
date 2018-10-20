<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

Class Exemple_constant_de_class {

	// convention : constantes en MAJUSCULE
	// ces variables NE SONT PAS DYNAMIQUES, elles seront tjrs les memes pour ttes les instances
	// et seront rattachees a la CLASSE et non l instance
	// elles ne vivent pas dans l instance
	// elles ne sont que dont le scope de la CLASSE
	const CST1 = 1;
	const CST2 = 2;
	
	public function __construct( array $kwargs ) {
		print( 'Constructor called' . PHP_EOL );

		// SELF est un mot cle et FAIT REFERENCE A LA CLASSE 
		// 		THIS fait reference a l instance courante
		// 		LA CLASSE est la partie STATIQUE que l on decrit declare dans le code
		// 		l INSTANCE est la partie DYNAMIQUE et est le resultat de l execution du code qui est dans la classe
		//
		// 		une CLASSE peut avoir plusieurs instances qui vont chacune avoir leur vie
		// 		une instance N A QU UNE SEULE et UNIQUE classe pour origine
		//
		// 		A chaque fois que l on veut faire reference a la classe ON UTILISERA le mot cle SELF
		//
		// l operateur :: est l operateur de PORTEE qui va permettre de resoudre des SCOPES de rentrer dans 
		// des scopes de + en + profond
		// dans php un scope : ce qui se trouve entre  {}
		//
		//::  == se trouve
		//LORSQUE JE VEUX y ACCEDER DANS la CLASSE
		//self::CST1 ==> je fais reference a la constante CST1 qui SE TROUVE dans self qui
		//fait reference a la CLASSE courante ie Example_constante_de_class
		if ( $kwargs['arg'] == self::CST1 ) 
			print( 'arg is CST1' . PHP_EOL );
		elseif ( $kwargs['arg'] == self::CST2 )
			print( 'arg is CST2' . PHP_EOL );
		else
			print( 'arg is not a class constant' . PHP_EOL );

		return;
	}

	public function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}
}

//
// avec les constantes, il n y pas de question de visibilite : il n y a pas de prive ou public . Donc il n y a pas 
// de raison de ne pas les utiliser a l exterieur de la classe
// je suis a l exterieur donc je n utilise pas self mais le nom de la classe Exemple_constant_de_class
// Exemple_constant_de_class::CST1 ==> je fais reference a CST1 qui se trouve dans la classe Exemple_constant_de_class
//
$instance1 = new Exemple_constant_de_class( array( 'arg' => Exemple_constant_de_class::CST1 ) ); 
$instance2 = new Exemple_constant_de_class( array( 'arg' => Exemple_constant_de_class::CST2 ) ); 
$instance2 = new Exemple_constant_de_class( array( 'arg' => 42 ) ); 

?>
