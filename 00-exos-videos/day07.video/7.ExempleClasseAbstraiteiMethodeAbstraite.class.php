<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * classe abstraite: interdiction de l instancier
 * Avoir une classe abstraite NOUS PERMET d avoir des methodes abstraites
 *
 * la classe abstract est interassant, cela va nous permettre tt simplement d ecrire des classes
 *  - qui ne vont pas contenir du code
 *  - MAIS qui vont contenir un ensembe de methodes qui doivent etre implementees par 
 *  les classes filles pour respecter un comportement
 *  --> ce mecanisme s appelle une INTERFACE: le principe est d obliger un comportement (poser un certain nbre de regles). C est une classe 
 *  qui n a pas valeur de donnees code a executer de concret mais juste de poser un certain nbre de regles sur la suite
 *
 */

// Mere
abstract Class ExempleClasseAbstraiteA {
	// Si j ai une classe abstraite alors j ai le droit de declarer une methode abstaite
	// On ne peut pas ne pas definir cette methode dans une classe heritee
	// ?? EST il possible de la DEFINIR ???
	// On dit simplement que foo() existe et qu elle prend un certain nbre de parametres
	abstract public function foo();		// <--- cela resemble aux prototypes de C

	// la methode Fille sera obligee de redefinir foo() et en realite a la definir car elle ne l a
	// jamais ete
	// C est une relation de contrat entre Mere et Fille: iFille est obligee d implementer foo()

}

//
Class ExempleClasseAbstraiteB extends ExempleClasseAbstraiteA {

	public function __construct() {
		print( 'Constructor ExempleClasseAbstraiteMethodeBBBBBBBBBBB called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleClasseAbstraiteMethodeBBBBBBBBBBB called' . PHP_EOL );
		return;
	}
	// override de la methode foo()
	/*
	public function foo() {
		print( '===> BBBBB: Function foo() class B: ' . PHP_EOL );
		return;
	}
	 */
}

print( PHP_EOL);

print( '---- B Fille appel instancier Fille ---- ' . PHP_EOL);
$instanceB = new ExempleClasseAbstraiteB();
//$instanceB->foo();
print( '---- B Fille END ---- ' . PHP_EOL);

?>
