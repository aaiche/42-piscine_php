<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

//
// Ce sont des outils bien pratiques de php
//
Class Exemple__get__set {

	private $_att = 0;
	
	public function getAtt() {
		return $this->_att;
	}

	public function setAtt( $v ) {
		if ( $this->_att + $v > 50 )
			$this->_att = 50;
		else
			$this->_att = $v;
		return;
	}

	// seront appeles si l utilisateur fait un appel  a un attribut qui n existe pas ou bien acces a attribut qui est prive
	// ON CONSIDERE QUE SI LE CODE de __get() ou __set() s execute : c est que qqchose SE PASSE MAL
	public function __get( $att ) {
		print( 'Attempt to access \'' . $att . '\' attribute, this script should die' . PHP_EOL );
		return 'arrrg';
	}
	public function __set( $att, $value ) {
		print( 'Attempt to set \'' . $att . '\' attribute to \'' . $value . '\', this script should die' . PHP_EOL );
		return;
	}

	function __construct( array $kwargs ) {
		print( 'Constructor called' . PHP_EOL );
		$this->setAtt(  $kwargs['arg'] );
		print( '$this->getAtt(): ' . $this->getAtt() . PHP_EOL );
		return;
	}

	// function qui sera appelee lorsque l instance est detruite. et la memoire est liberee
	function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}
}

$instance = new Exemple__get__set( array( 'arg' => 42 ) );

// 'foo' N existe PAS
// 'attr' existe, mais EST PRIVATE 
// __get() est appellee
print ( '$instance->foo: ' . $instance->foo . PHP_EOL );
print ( '$instance->_att: ' . $instance->_att . PHP_EOL );

// 'foo' N existe PAS
// 'attr' existe, mais EST PRIVATE 
// __set() est appellee
$instance->foo = 21;
$instance->_att = 84;

?>
