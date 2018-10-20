<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * heritage: 
 * la classe fille va heriter de ttes les methodes et attributs de la classe parente
 * Est ce que cela a du sens de faire heriter ? 
 * 		Est ce que la classe Fille est une classe Mere ? la Classe Fille est une Classe Mere
 * 		La classe Mere est une version GENERALE de la classe Fille
 * 		Et inversement La classe Fille une version SPECIALISEE de la classe Mere
 * Question a se poser de l heritage : Est ce que la classe Fille est une classe Mere ?
 * 		Si oui, alors on peut utiliser l heritage
 */
Class Mere {

	public $att = 0;

	public function __construct() {
		print( 'Constructor Mere called' . PHP_EOL );
		$this->att = 21;
		return;
	}

	public function __destruct() {
		print( 'Destructor Mere called' . PHP_EOL );
		return;
	}
	
	public function foo() {
		print( '           ===> Mere: Function foo() appartient a la class Mere, $this->att is ' . $this->att . PHP_EOL );
		return;
	}
}

// 
// on peut dire HERITE DE ou bien la classe Fille EST une classe Mere
// mot "extends" permet de dire :
// 		Dans la definition de la classe Fille, j y trouve des choses (peut etre des attributs des methodes) MAIS
// 		que en tout cas je vais y retrouver tout ce qui existait dans la classe Mere, a savoir 
// 		l attribut Mere-att et la methode Mere-foo vont automatiquement se retrouver  defini/existe dans la classe Fille
//
Class Fille extends Mere {
	// ICI on ne definit pas att ni la methode foo()

	//l attribut 'att' se tourve ici
	public function __construct() {
		print( 'Constructor Fille called' . PHP_EOL );
		$this->att = 42;
		return;
	}

	public function __destruct() {
		print( 'Destructor Fille called' . PHP_EOL );
		return;
	}
	// la methode foo se trouve ici
}

// pour instancier Fille je n ai pas besoin d avoir instancier Mere
//$instanceMere = new Mere();
//$instanceMere->foo();

$instanceFille = new Fille();
$instanceFille->foo();

echo "\nRemarquez: la destruction se fait dans le sens contraire de la construction\n";

?>
