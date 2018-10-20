<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

//
// dans la vraie vie, on met tous les attributs en prive, pour pouvoir garder un controle dessus
// on fournit qd meme a l utilisateur une vue sur ces attributs. On utilise pour cela des accessors
//
//
Class Exemple_accessors {

	private $_att = 0;
	
	// accessor: gettor ATTENTION PAS DE _
	// Convention: on met 'get' devant le nom de l attribut et on enleve le '_'
	public function getAtt() { return $this->_att; }

	// accessor: settor
	public function setAtt( $v ) { 
		if ( $this->_att + $v > 50 )
			$this->_att = 50;
		else
			$this->_att = $v;
		return;
	}

	// On utilise systematiquement les accessors dans le code de la classe
	// On peut aussi avoir des accessors private et qui ne seront jamais visibles de l exterieur
	public function __construct( array $kwargs ) {
		print( 'Constructor called' . PHP_EOL );
		$this->setAtt( $kwargs['arg'] );
		print( '$this->getAtt(): ' . $this->getAtt() . PHP_EOL );
		return;
	}

	public function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}

}

$instance1 = new Exemple_accessors( array( 'arg' => 42 ) );
$instance2 = new Exemple_accessors( array( 'arg' => 53 ) );

$instance1->setAtt( 30 );
print( '$instance1->getAtt(): ' . $instance1->getAtt() . PHP_EOL );

print ( '---- End     ----' . PHP_EOL );

?>
