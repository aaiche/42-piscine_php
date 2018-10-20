<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * classe interface : la relation d heritage est differente, php introduit un nouveau vocabulaire
 * 		- on NE va PAS dire que Fille est une classe Mere,
 * 		mais
 * 		- Fille  implemente une interface
 *	une interface est une classe:
 *		- qui est abstraite
 *		- qui ne contient que des methodes abstraites
 *		- qui ne contient pas d attributs
 *		- on peut y trouver des constantes
 *	Si les conditions ci-dessous sont respectees, on ne parlera plus de classe abstraite mais de INTERFACE
 */

// interface Mere
// par convention on met I devant le nom de la classe
// interface == abstract class
interface IExempleInterfaceA {
	// code vide
	// pas de mot abstract devant la  methode
	// par defaut ttes les methodes dans une interface sont abstraites
	function foo();


	// --> ttes les classes implementant IExempleInterfaceA doivent implementer foo()
}

//
// une classe implemente une interface
//
Class Exemple implements IExempleInterfaceA {

	public function __construct() {
		print( 'Constructor Exemple called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor Exemple called' . PHP_EOL );
		return;
	}
	// override de la methode foo()
	public function foo() {
		print( '===> Exemple : Function foo() class B: ' . PHP_EOL );
		return;
	}
}

print( '---- B Fille appel instancier Fille ---- ' . PHP_EOL);
$instanceB = new Exemple();
$instanceB->foo();
print( '---- B Fille END ---- ' . PHP_EOL);

?>
