<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * Visibilite VERTICALE
 * heritage: on introduit une relation verticale entre 2 classes. Cela signifie que la question de visibilite
 * se pose a nouveau. Sachant que l on a des attributs/methodes prives ou publics et on sait comment cela fonctionne
 * de l exterieur, MAIS Q EN EST T IL entre une classe Mere et une classe Fille
 *
 * Dans la classe Fille, on est considere comme a l exterieur de la classe Mere
 * 		- Tout ce qui est PRIVE dans la classe Mere le reste.
 * 		  La classe fille NE POURRA PAS ACCEDER a ce qui est prive dans la classe Mere
 * 		- Tout ce qui est PUBLIC dans la classe Mere le reste. Fille pourra y acceder
 * Mais cela pose un probleme: si on herite d une classe, cela veut dire que l on veut etendre ces fonctionnalites. C est le boulot
 * du developpeur et on est pas a l exterieur de la classe Mere. Donc on aimerait bien pouvoir acceder aux donnees de la classe Mere.
 * C est pourquoi dans tous les langages, on introduit un 3 eme mot cle PROTCTED qui va se situer entre le Prive et le Public
 *
 * Les regles sont les suivantes:
 * 	- a l exterieur de la classe, Protected a le meme comportement que le Prive. Tout ce qui est protected 
 * 	n est pas accessible depuis l extexterieur de la classe
 * 	- a l interieur de la classe Fille, Protected sera accessible 
 */

// classe Mere
Class ExempleProtectedA {

	public 		$publicAtt = 21;
	// protected : d un point de vue de l exterieur de la classe: cela a le meme propiete que le private
	// tt ce qui est proteced est inaccessible depuis l exterieur de la classe
	// par contre a l interieur de la classe (i.e. fille) ce sera visible dans la classe Fille
	protected	$_protectedAtt = 82;
	private 	$_privateAtt = 42;

	public function __construct() {
		print( 'Constructor ExempleProtectedA called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleProtectedA called' . PHP_EOL );
		return;
	}
	
	public function publicFoo() {
		print( '           ===> AAAAA: Function PUBLIC foo() class A' . PHP_EOL );
		return;
	}

	protected function _protectedFoo() {
		print( '           ===> AAAAA: Function PROTECTED foo() class A' . PHP_EOL );
		return;
	}

	private function _privateFoo() {
		print( '           ===> AAAAA: Function PiRIVATE foo() class A' . PHP_EOL );
		return;
	}

	public function test() {
		print( '           ===> AAAAA: Function PUBLIC test() class A: Depuis la Classe Mere: j ai acces a tt ce qui est PUBLIC PROTECTED et PRIVATE' . PHP_EOL );
		print( '$this->publicAtt is ' . $this->publicAtt . PHP_EOL);
		print( '$this->_protectedAtt is ' . $this->_protectedAtt . PHP_EOL);
		print( '$this->_privateAtt is ' . $this->_privateAtt . PHP_EOL);
		$this->publicFoo();
		$this->_protectedFoo();
		$this->_privateFoo();
		return;
	}
}

//
Class ExempleProtectedB extends ExempleProtectedA {

	//l attribut 'att' se tourve ici
	public function __construct() {
		print( 'Constructor ExempleHeritageBBBBBBBBBBBBB called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleHeritageBBBBBBBBBBBBB called' . PHP_EOL );
		return;
	}

	// OVERride de la fonction Mere-test()
	public function test() {
		print( '           ===> BBBBB: Function PUBLIC test() class B: Depuis la Classe Fille: j ai acces a tt ce qui est PUBLIC PROTECTED et NON PRIVATE' . PHP_EOL );
		print( '$this->publicAtt is ' . $this->publicAtt . PHP_EOL);
		print( '$this->_protectedAtt is ' . $this->_protectedAtt . PHP_EOL);
		print( '$this->_privateAtt is ' . $this->_privateAtt . PHP_EOL);
		$this->publicFoo();
		$this->_protectedFoo();
		$this->_privateFoo();
		return;
	}
}

print( '---- From inside A Mere ---- ' . PHP_EOL);
$instanceA = new ExempleProtectedA();
$instanceA->test();
print( '---- From inside A Mere END ---- ' . PHP_EOL);

print( '---- From inside B Fille ---- ' . PHP_EOL);
$instanceB = new ExempleProtectedB();
$instanceB->test();
print( '---- From inside B Fille END ---- ' . PHP_EOL);

print( '---- From outside ---- ' . PHP_EOL);
print( '$instanceB->publicAtt is ' . $instanceB->publicAtt . PHP_EOL);
$instanceB->publicFoo();
print( '---- From outside ---- ' . PHP_EOL);

?>
