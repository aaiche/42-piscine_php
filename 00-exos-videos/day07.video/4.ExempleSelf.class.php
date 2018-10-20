<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * self n est pas uniquement lie aux methodes statiques de la classe 
 * self va nous permettre de determiner a quelle hauteur dans l arbre d heriatge on se trouve pour pouvoir appeler une 
 * methode precise
 *
 * ??self permet de retirer l override ??. la classe mere sera utilise
 * self aura le meme comportement que ce soit une methode normale ou statique
 */

// classe Mere
Class ExempleSelfA {

	public function __construct() {
		print( 'Constructor ExempleSelfA called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleSelfA called' . PHP_EOL );
		return;
	}
	
	public function foo() {
		print( '===> AAAAA: Function foo() class A' . PHP_EOL );
		return;
	}

	public function test() {
		print( '===> AAAAA: Function test() class A: ' . PHP_EOL );
		// la Mere ne veut utiliser que son foo() meme si il est overide pas les filles
		// self fait reference a la classe courante. i.e. qd on est dans la classe A, self va valoir la classe A. Par heritage, qd
		// on se retrouve dans la classe Fille, un appel de test() heritee de Mere que va valoir self ?
		// 		- ce serait logique de penser que etant donne que on est dans la classe Fille, self aura la valeur Fille !!
		// 		==> Ce sera celle de la Mere qui sera utilise
		//
		self::foo();
		return;
	}
}

// classe Fille
Class ExempleSelfB extends ExempleSelfA {

	public function __construct() {
		print( 'Constructor ExempleSelfBBBBBBBBBBB called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleSelfBBBBBBBBBBB called' . PHP_EOL );
		return;
	}
	// override de la methode foo()
	public function foo() {
		print( '===> BBBBB: Function foo() class B: ' . PHP_EOL );
		return;
	}


	// test() se trouve et est herite de la classe A
	// que va referencer self ici ??
}

print( '---- A Mere appel foo()---- ' . PHP_EOL);
$instanceA = new ExempleSelfA();
$instanceA->foo();
print( '---- A Mere END ---- ' . PHP_EOL);

print( PHP_EOL);

print( '---- B Fille appel foo() ---- ' . PHP_EOL);
$instanceB = new ExempleSelfB();
$instanceB->foo();
print( '---- B Fille END ---- ' . PHP_EOL);

print( PHP_EOL);

print( '---- A Mere appel test()---- ' . PHP_EOL);
$instanceA->test();
print( '---- A Mere END ---- ' . PHP_EOL);

print( PHP_EOL);

print( '---- B Fille appel test()---- ' . PHP_EOL);
$instanceB->test();
print( '---- B Fille END ---- ' . PHP_EOL);

?>
