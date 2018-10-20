<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

Class Exemple__invoke {

	private $_x = 0;
	private $_y = 0;
	
	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }

	public function setX( $x ) { $this->_x = $x; return; }
	public function setY( $y ) { $this->_y = $y; return; }

	public function __construct( ) {
		print( 'Constructor called' . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}

	// permet a une INSTANCE de se comporter COMME UNE FONCTION: i.e. on va pouvoir utiliser 
	// la syntaxe de l appel d une fonction sur une instance et esperer un comportement PARTICULIER
	public function __invoke() {
		return $this->getX() + $this->getY();
	}
}

$instance = new Exemple__invoke(); 
$instance->setX( 10 );
$instance->setY( 32 );

//
// ici on on APPELLE instance qui est tres tres PRATIQUE
// On parle de functor
// voir CLOSURE (english) ou FERMETURE LEXICALE (french)
print ( $instance() . PHP_EOL );

?>
