<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

Class Exemple__clone {

	private $_att = 0;
	
	public function getAtt() { return $this->_att; }
	public function setAtt( $v ) { $this->_att = $v; return; }

	public function __construct( array $kwargs ) {
		print( 'Constructor called' . PHP_EOL );
		$this->setAtt( $kwargs['arg'] );
		return;
	}

	public function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}

	// 
	// instance dupliquee en memoire et chacune vit sa vie. et je ne veux pas reconstuire l instance
	// 
	public function __clone() {
		print( 'Clone called' . PHP_EOL );
		return;
	}
}

print ( '---- Sharing ----' . PHP_EOL );
print ( '---- 2 instances qui pointent sur la meme zone memoire----' . PHP_EOL );
print ( '---- Remarquez le nbre de Constructor()               ----' . PHP_EOL );
// 2 insta
$instance1 = new Exemple__clone( array( 'arg' => 42) ); 
$instance2 = $instance1;
print ( '$instance1->getAtt(): ' . $instance1->getAtt()  . PHP_EOL );
print ( '$instance2->getAtt(): ' . $instance2->getAtt()  . PHP_EOL );
$instance1->setAtt( 30 );
print ( '$instance1->getAtt(): ' . $instance1->getAtt()  . PHP_EOL );
print ( '$instance2->getAtt(): ' . $instance2->getAtt()  . PHP_EOL );

//
// ici on on APPELLE instance qui est tres tres PRATIQUE
// voir closure ou fermeture lexicale


print ( '---- Cloning ----' . PHP_EOL );
print ( '---- 2 instances qui pointent sur des zones memoire DIFFERENTES----' . PHP_EOL );
print ( '1 seul constructor est appele:' . PHP_EOL );
$instance3 = new Exemple__clone( array( 'arg' => 42) ); 
$instance4 = clone $instance3;
print ( '$instance3->getAtt(): ' . $instance3->getAtt()  . PHP_EOL );
print ( '$instance4->getAtt(): ' . $instance4->getAtt()  . PHP_EOL );
$instance3->setAtt( 30 );
print ( '$instance3->getAtt(): ' . $instance3->getAtt()  . PHP_EOL );
print ( '$instance4->getAtt(): ' . $instance4->getAtt()  . PHP_EOL );

print ( '---- End : Remarquez le nbre de Destructor() appeles    ----' . PHP_EOL );


?>
