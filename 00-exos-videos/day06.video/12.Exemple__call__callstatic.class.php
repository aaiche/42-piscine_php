<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

Class Exemple__call__callstatic {
	//
	// cf __get et __set
	//

	public function __construct() {
		print( 'Constructor called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}
	
	// 
	// si on fait appel a une methode 
	// 	- QUI N EXISTE PAS ou bien QUI EST PRIVE 
	// ==> C EST UN CAS D ERREUR
	public function __call( $f, $args ) {
		print( 'Attempt to call function \'' . $f . '\' with params ' );
		print_r( $args );
		// ==> C EST UN CAS D ERREUR
		return;
	}
	
	// 
	// si on fait appel a une methode STATIC
	// 	- QUI N EXISTE PAS ou bien QUI EST PRIVE 
	// ==> C EST UN CAS D ERREUR
	//
	public static function __callstatic( $f, $args ) {
		print( 'Attempt to call static function \'' . $f . '\' with params ' );
		print_r( $args );
		// ==> C EST UN CAS D ERREUR
		return;
	}
}

$instance = new Exemple__call__callstatic();
print ( '---- calling foo() of instance : foo n existe pas ----' . PHP_EOL );
$instance->foo( 1, 2, 3 );
print ( '---- calling static bar() of class : bar  n existe pas ----' . PHP_EOL );
Exemple__call__callstatic::bar( 4, 5, 6 );

print ( '---- End     ----' . PHP_EOL );

?>
