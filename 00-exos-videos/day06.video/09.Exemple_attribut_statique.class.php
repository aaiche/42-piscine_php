<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

Class Exemple_attribut_statique {
	//
	// Un attribut statique va vivre au nivequ de la CLASSE et PAS au niveau de l instance
	// On peut ecrire ou read MAIS SE FAIT dans le scope de la CLASSE et n a pas d incidence dans
	// ce que l on fait dans l instance
	//
	
	// 
	// exple : on incremente a chaque que l on cree une instance
	// et on decremente lorsque elle est detruite
	public static $nbInstances = 0;

	public function __construct() {
		print( 'Constructor called' . PHP_EOL );
		self::$nbInstances++;
		return;
	}

	public function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		self::$nbInstances--;
		print( 'nb instances: ' . Exemple_attribut_statique::$nbInstances . PHP_EOL );
		return;
	}
}


print( 'nb instances: ' . Exemple_attribut_statique::$nbInstances . PHP_EOL );
$instance1 = new Exemple_attribut_statique();
print( 'nb instances: ' . Exemple_attribut_statique::$nbInstances . PHP_EOL );
$instance2 = new Exemple_attribut_statique();
print( 'nb instances: ' . Exemple_attribut_statique::$nbInstances . PHP_EOL );
$instance3 = new Exemple_attribut_statique();
print( 'nb instances: ' . Exemple_attribut_statique::$nbInstances . PHP_EOL );

print( PHP_EOL . '---- End ----' . PHP_EOL . PHP_EOL);

?>
