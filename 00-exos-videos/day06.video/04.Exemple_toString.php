<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

// permet de serialiser = transformer une instance en une chaine de characteres
Class Exemple_toString {

	private $_att = 0;
	
	public function getAtt() {
		return $this->_att;
	}

	public function setAtt( $v ) {
		$this->_att = $v;
		return;
	}

	function __construct( array $kwargs ) {
		print( 'Constructor called' . PHP_EOL );
		$this->setAtt(  $kwargs['arg'] );
		return;
	}

	function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}

	// Methode speciale tres pratique qd on veut debuger ou faire du log
	// permet de serialiser = transformer une instance en une chaine de characteres
	function __toString() {
		return 'Exemple_toString( $_att = ' . $this->getAtt() . ' )';
	}
}

$instance = new Exemple_toString( array( 'arg' => 42 ) );

// On fait un print DIRECTEMENT sur l INSTANCE
print ( $instance . PHP_EOL );

?>
