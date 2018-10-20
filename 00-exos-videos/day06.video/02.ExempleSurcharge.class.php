<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

// Dans de nombreux langages: La surcharge d une fonction ou d une methode consiste a pouvoir ecrire differentes versions d une meme
// methode ou fonction avec des parametres qui ont des types et un nombre de parametres qui change
Class ExempleSurcharge {
	// Pas de surcharge possible dans php
	// ici on utilise un trick en particulier pour les constructor et amener un peu de soupless
	// methode inspiree de python

	public $att1 = 0;
	public $att2 = 0;
	public $att3 = 0;
	
	//en input 1 dictionnaire kwargs === 'key words args' 
	//et on oblige que le type soit un ARRAY. le programme va verifier que c est bien un array
	//cette verification (obligation) ne fonctionne pas avec les types scalaires
	//on peut AUSSI  mettre une CLASSE
	function __construct( array $kwargs ) {
		print( 'Constructor called' . PHP_EOL );

		if ( array_key_exists( 'arg1', $kwargs ) )
			$this->att1 = $kwargs['arg1'];
		else
			$this->att1 = -1;

		// arg2 est obligatoire si il n est pas passe il y a error
		$this->att2 = $kwargs['arg2'];

		if ( array_key_exists( 'arg3', $kwargs ) )
			$this->att3 = $kwargs['arg3'];
		else
			$this->att3 = -1;

		print( '$this->att1: ' . $this->att1 .  PHP_EOL );
		print( '$this->att2: ' . $this->att2 .  PHP_EOL );
		print( '$this->att3: ' . $this->att3 .  PHP_EOL );


		return;
	}

	// function qui sera appelee lorsque l instance est detruite. et la memoire est liberee
	function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}
}

$instance = new ExempleSurcharge( array( 'arg3' => 31, 'arg1' => 53 ) );
$instance = new ExempleSurcharge( array( 'arg1' => 53, 'arg2' => 42, 'arg3' => 31 ) );
$instance = new ExempleSurcharge( array( 'arg3' => 31, 'arg2' => 42, 'arg1' => 53 ) );
$instance = new ExempleSurcharge( array( 'arg2' => 42 ) );
$instance = new ExempleSurcharge( array( 'arg3' => 31, 'arg2' => 42 ) );
$instance = new ExempleSurcharge( array( 'arg3' => 31, 'arg1' => 53 ) );


?>
