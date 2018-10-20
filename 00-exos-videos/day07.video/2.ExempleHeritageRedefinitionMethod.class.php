<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * heritage: 
 */
Class ExempleHeritageRedefinitionMethodA {

	public function __construct() {
		//print( '------------------------' . PHP_EOL );
		//print( '__construct(): je suis dans la classe A' . PHP_EOL );
		//print( '------------------------' . PHP_EOL );
		print( 'Constructor ExempleHeritageA called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		//print( '------------------------' . PHP_EOL );
		//print( '__destruct(): je suis dans la classe A' . PHP_EOL );
		//print( '------------------------' . PHP_EOL );
		print( 'Destructor ExempleHeritageA called' . PHP_EOL );
		return;
	}
	
	public function foo() {
		//print( '------------------------' . PHP_EOL );
		//print( 'foo(): je suis dans la classe A' . PHP_EOL );
		//print( '------------------------' . PHP_EOL );
		print( '           ===> AAAAA: Function foo() From class A ' . PHP_EOL );
		return;
	}
}

Class ExempleHeritageRedefinitionMethodB extends ExempleHeritageRedefinitionMethodA {

	public function __construct() {
		//print( '------------------------' . PHP_EOL );
		//print( '__construct(): je suis dans la classe B' . PHP_EOL );
		//print( '------------------------' . PHP_EOL );

		// :: --> operateur de portee
		parent::__construct();	// <-- fait l initialisation de ce qui est general

		// ici on fait l initialisation de ce qui est special
		print( 'Constructor ExempleHeritageBBBBBBBBBBBBB called' . PHP_EOL );
		$this->att = 42;
		return;
	}

	public function __destruct() {
		//print( '------------------------' . PHP_EOL );
		//print( '__destruct(): je suis dans la classe B' . PHP_EOL );
		//print( '------------------------' . PHP_EOL );
		print( 'Destructor ExempleHeritageBBBBBBBBBBBBB called' . PHP_EOL );
		parent::__destruct();
		return;
	}
	// REDEFINITION de la mehode foo()
	// redefinition de methodes === OVERride
	public function foo() {
		//print( '------------------------' . PHP_EOL );
		//print( 'foo(): je suis dans la classe B' . PHP_EOL );
		//print( '------------------------' . PHP_EOL );
		parent::foo();		// <--- ICI ON PROFITE de CE QUE FAIT la classe PARENTE
							// <--- parent mot cle un peu comme self
		print( '           ===> BBBBB: Function foo() Frome class B ' . PHP_EOL );
		return;
	}
}

// pour instancier B je n ai pas besoin d avoir instancier A
echo "-----------------------------------------------\n";
echo "- new Mere                                    -\n";
echo "-----------------------------------------------\n";
$instanceA = new ExempleHeritageRedefinitionMethodA();
echo "-----------------------------------------------\n";
echo "- Mere->foo()                                  -\n";
echo "-----------------------------------------------\n";
$instanceA->foo();

echo "-----------------------------------------------\n";
echo "- new Fille                                   -\n";
echo "-----------------------------------------------\n";
$instanceB = new ExempleHeritageRedefinitionMethodB();
echo "-----------------------------------------------\n";
echo "- Fille->foo()                                 -\n";
echo "-----------------------------------------------\n";
$instanceB->foo();


?>
