<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

Class Exemple_comparaisons {

	public $x = 0;
	public $y = 0;
	
	public function __construct( array $kwargs ) {
		print( 'Constructor called' . PHP_EOL );
		$this->x = $kwargs['x'];
		$this->y = $kwargs['y'];
		return;
	}

	public function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}

}

// instance1 et instance2 sont des zones memoire DIFFERENTES
$instance1 = new Exemple_comparaisons( array( 'x' => 12, 'y' => 34 ) );
$instance2 = new Exemple_comparaisons( array( 'x' => 12, 'y' => 34 ) );

// instance1 et instance3 sont dans les MEMES zones memoire
// on parle de reference. instance 3 utilise la meme zone memoire. instance1 et instance3 referencent la MEME zone memoire
$instance3 = $instance1;

//
// == comparaison structurelle.: on compare le contenu. Elle verifie que les 2 instances (meme si elles ne sont pas dans le meme endroit de la memoire)
// sont bien dans le meme etat et sont parfaitement equivalentes l une a l autre
// 
if ( $instance1 == $instance2 )
	print( '$instance1 == $instance2' . PHP_EOL );
else
	print( '$instance1 != $instance2' . PHP_EOL );

if ( $instance1 == $instance3 )
	print( '$instance1 == $instance3' . PHP_EOL );
else
	print( '$instance1 != $instance3' . PHP_EOL );

//
// === comparaison physique. Est ce que les 2 variables font reference a la MEME instance physiquement
// (est ce que c est le MEME endroit dans la memoire)
// 
if ( $instance1 === $instance2 )
	print( '$instance1 === $instance2' . PHP_EOL );
else
	print( '$instance1 !== $instance2' . PHP_EOL );

if ( $instance1 === $instance3 )
	print( '$instance1 === $instance3' . PHP_EOL );
else
	print( '$instance1 !== $instance3' . PHP_EOL );

print ( '---- End     ----' . PHP_EOL );

?>
