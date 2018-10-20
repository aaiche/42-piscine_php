<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * classe abstraite: interdiction de l instancier
 *
 * Il peut etre tt a fait  pertinent de regrouper au sein d une classe des comportements qui allaient
 * etre utiles une fois specialise, mais en soi ne servaient a rien. Par exple, on pourrait avoir une
 * classe qui pourra definir des comportements de base pour un personnage et que les classes specialisees
 * vont etre un guerrier, un mage, ... et que les classes Filles vont veritablement faire le travail et que
 * finalement tout ce qu on va trouver dans la classe Mere ce sont des donnees generales mais qui n ont pas
 * d interet en elles meme, c-a-d instancier une classe n a pas de sens
 * A force de travaiiler dans cette direction, certains langages ont fait le choix de proposer une syntaxe qui permet 
 * d interdire explicitement d instancier une classe
 */

// Mere
// En mettant le mot cle devant la classe, on interdit tt simplement d instancier cette classe
abstract Class ExempleClasseAbstraiteA {
	// code: on ne pourra l utiliser uniquement que lors de l heritage

}

// Fille
Class ExempleClasseAbstraiteB extends ExempleClasseAbstraiteA {

	public function __construct() {
		print( 'Constructor ExempleClasseAbstraiteBBBBBBBBBBB called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleClasseAbstraiteBBBBBBBBBBB called' . PHP_EOL );
		return;
	}
	// override de la methode foo()
	public function foo() {
		print( '===> BBBBB: Function foo() class B: ' . PHP_EOL );
		return;
	}
}

print( '---- A Mere instancier Mere Ce n est pas possible ---- ' . PHP_EOL);
//$instanceA = new ExempleClasseAbstraiteA();
print( '---- A Mere END ---- ' . PHP_EOL);

print( PHP_EOL);

print( '---- B Fille appel instancier Fille ---- ' . PHP_EOL);
$instanceB = new ExempleClasseAbstraiteB();
print( '---- B Fille END ---- ' . PHP_EOL);

?>
