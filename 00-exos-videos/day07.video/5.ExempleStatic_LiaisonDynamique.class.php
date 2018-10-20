<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * methode statique, ie static function toto() : methode de la classe cf hier
 * aujourdhui on utilisera nous allons aborder le mot cle static pour designer qqchose de completement different
 * 
 * [dans les langages,  tt le code d une fonction ou d une methode a une liason. Il y a 
 * 	- la liaison statique (qui n a rien a avoir avec ce qui a ete vu hier): elle est definie a la compilation, i.e. 
 * 	elle est definie en 'dur' et une bonne fois pour toute
 * 	- la liason dynamique: signifie la liason est realisee a l'execution
 * 	on peut retenir ceci qui est valable partout sauf en php:
 * 		* ce qui est statique est lie a la compilation, i.e. a la redaction du code, c est grave dans le marbre
 * 		* ce qui est dynamique est lie a l execution, c est uniquement decouvert a l execution
 * 	]
 * 	Les methodes que l on a ecrit jusqu a present, avaient toutes une liaison statique. 
 *
 * 	Maintenant on va decouvrir un nouveau mot cle static qui va nous permettre de faire une liaison dynamique
 * 	 	
 *
 */

// classe Mere
Class ExempleStaticA {

	public function __construct() {
		print( 'Constructor ExempleStaticA called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleStaticA called' . PHP_EOL );
		return;
	}
	
	public function foo() {
		print( '===> AAAAA: Function foo() class A' . PHP_EOL );
		return;
	}

	public function test() {
		print( '===> AAAAA: Function test() class A - ici on fait static:foo(): ' . PHP_EOL );
		// !!!! c est une liason dynamique -----> Ce sera a l execution que la bonne methode sera choisie
		// le mot cle ici static veut dire  dynamique
		// // c est l inverse de self, voir exple 4.xxx
		// La mere dit que ce sera a mes filles d utiliser leur foo()
		static::foo();	// <--- c est l instance de la classe qui determinera ce qui sera utilise
		return;


		// Pour resumer:
		// 		- qd on utilise self::toto(), va nous permettre une liaison statique. c-a-d le code va etre definie
		// 		une bonne pour toute. la classe qui utilise self sera tjrs la classe qui sera utilise pour resoudre la methode
		// 		- qd ou utilise static:toto(), va nous permettre une liaison dynamique. c-a-d ce sera l instance de la classe qui 
		// 		va permettre de determiner quel code sera effectivement utilise 
		// Pour resumer encore:
		// 		- self: fait une liaison statique
		// 		- static: fait une liason dynamique
		//	
	}
}

// Fille
Class ExempleStaticB extends ExempleStaticA {

	public function __construct() {
		print( 'Constructor ExempleStaticBBBBBBBBBBB called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleStaticBBBBBBBBBBB called' . PHP_EOL );
		return;
	}
	// override de la methode foo()
	public function foo() {
		print( '===> BBBBB: Function foo() class B: ' . PHP_EOL );
		return;
	}

	// test() se trouve et est herite de la classe A
	// que va referencer static ?? 
	// 		==> ce sera Fille-foo()
}

print( '---- A Mere appel foo()---- ' . PHP_EOL);
$instanceA = new ExempleStaticA();
$instanceA->foo();
print( '---- A Mere END ---- ' . PHP_EOL);

print( PHP_EOL);

print( '---- B Fille appel foo() ---- ' . PHP_EOL);
$instanceB = new ExempleStaticB();
//$instanceB->foo();
print( '---- B Fille END ---- ' . PHP_EOL);

print( PHP_EOL);

print( '---- A Mere appel test()---- ' . PHP_EOL);
$instanceA->test();
print( '---- A Mere END ---- ' . PHP_EOL);

print( PHP_EOL);

print( '---- B Fille appel test()---- ' . PHP_EOL);
$instanceB->test();
print( '---- B Fille END ---- ' . PHP_EOL);
exit;

?>
