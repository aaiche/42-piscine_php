<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

Class Exemple {
	//
	// donnees == variables de classe == appeles attributs
	//
	
	// visibilite: on parle d encapsulationa
	// 		il faut faire la disctinction 
	// 			- entre le code qui :
	// 				DOIT rester interne a la classe et utilise uniquement par le develeppeur de la classe
	// 			- le code qui peut etre utilise depuis l exterieur de la classe

	// public: 
	// initialiser UNIQUEMENT avec des CONSTANTES. i.e. pas de calcul ni d appels de fonctions. On est 
	// oblige d utiliser les constantes pour initialiser les attributs
	public 	$public_foo = 0;			// accessible depuis l exterieur en write et read
	private $_private_foo = 'hello';

	// $this est un mot cle et designe l instance courante de la classe dans le code de la classe 
	// pas de '_' : public
	//     un '_' : private
	//    un '__' : methode speciale reserve a php
	
	//
	// fonction : on les appelle methodes
	//
	
	// function qui sera appelee lorsque la classe va etre instanciee
	// public par defaut
	function __construct() {
		print( 'Constructor() called' . PHP_EOL );

		print( '$this->public_foo: ' . $this->public_foo .  PHP_EOL );
		$this->public_foo = 42; 	// on utilise $this pour interroger l instance courante de l classe sur son etat
		print( '$this->public_foo: ' . $this->public_foo .  PHP_EOL );

		print( '$this->private_foo: ' . $this->_private_foo .  PHP_EOL );
		$this->_private_foo = 'world';
		print( '$this->private_foo: ' . $this->_private_foo .  PHP_EOL );

		$this->public_bar();
		$this->_private_bar();

		return;
	}

	// function qui sera appelee lorsque l instance est detruite. et la memoire est liberee
	// public par defaut
	function __destruct() {
		print( 'Destructor() called' . PHP_EOL );
		return;
	}
	
	// public par defaut
	function public_bar() {
		print( 'Method public_bar() called' . PHP_EOL );
		return;
	}

	private function _private_bar() {
		print( 'Method _private_bar() called' . PHP_EOL );
		return;
	}
}

// instancier : la variable $instance est egale a une nouvelle instance de la classe Example
$instance = new Exemple();

print ( '$instance->public_foo: ' . $instance->public_foo . PHP_EOL );
$instance->public_foo = 100;
print ( '$instance->public_foo: ' . $instance->public_foo . PHP_EOL );
$instance->public_bar();

print ( '$instance->_private_foo: ' . $instance->_private_foo . PHP_EOL );
$instance->public_foo = 100;
print ( '$instance->_private_foo: ' . $instance->_private_foo . PHP_EOL );
$instance->_private_foo();


?>
