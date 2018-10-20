<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * 
 */
abstract class Mere {

	public function __construct() {
		print( 'Constructor of Mere called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor Mere called' . PHP_EOL );
		return;
	}

	abstract public function foo();
	
}

// final: personne ne pourra heriter de Fille
final class Fille extends Mere {

	public function __construct() {
		print( 'Constructor of Fille called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor Fille called' . PHP_EOL );
		return;
	}

	final public function foo() {
		print( 'foo() of Fille' . PHP_EOL );
		return;
	}

}


/*
 * fatal error
 */
class PetiteFille extends Fille {

	public function __construct() {
		print( 'Constructor of PetiteFille called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor PetiteFille called' . PHP_EOL );
		return;
	}

	public function foo() {
		print( 'foo() of PetiteFille' . PHP_EOL );
		return;
	}

}


// 

?>
