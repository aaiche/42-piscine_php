<?php

/**
  * Class : Matrix.class.php
  * 
  *	Description:
  *
  * Available options:
  *
  * @param 	array	$parameters	An associative array of initilisation parameters
  * 							$parmaters might be 
  * 								- ('x' => value)		==> mandatory
  * 								- ('y' => value)		==> mandatory
  * 								- ('z' => value)		==> mandatory
  * @param 
  * 
  * @return 
  * 
  * @throws ...
  * 
  * @version 0.1.0
  */

require_once 'Color.class.php';
/*
Class Exemple_constant_de_class {

	// convention : constantes en MAJUSCULE
	// ces variables NE SONT PAS DYNAMIQUES, elles seront tjrs les memes pour ttes les instances
	// et seront rattachees a la CLASSE et non l instance
	// elles ne vivent pas dans l instance
	// elles ne sont que dont le scope de la CLASSE
	const CST1 = 1;
	const CST2 = 2;
	
	public function __construct( array $kwargs ) {
		print( 'Constructor called' . PHP_EOL );

		// SELF est un mot cle et FAIT REFERENCE A LA CLASSE 
		// 		THIS fait reference a l instance courante
		// 		LA CLASSE est la partie STATIQUE que l on decrit declare dans le code
		// 		l INSTANCE est la partie DYNAMIQUE et est le resultat de l execution du code qui est dans la classe
		//
		// 		une CLASSE peut avoir plusieurs instances qui vont chacune avoir leur vie
		// 		une instance N A QU UNE SEULE et UNIQUE classe pour origine
		//
		// 		A chaque fois que l on veut faire reference a la classe ON UTILISERA le mot cle SELF
		//
		// l operateur :: est l operateur de PORTEE qui va permettre de resoudre des SCOPES de rentrer dans 
		// des scopes de + en + profond
		// dans php un scope : ce qui se trouve entre  {}
		//
		//::  == se trouve
		//LORSQUE JE VEUX y ACCEDER DANS la CLASSE
		//self::CST1 ==> je fais reference a la constante CST1 qui SE TROUVE dans self qui
		//fait reference a la CLASSE courante ie Example_constante_de_class
		if ( $kwargs['arg'] == self::CST1 ) 
			print( 'arg is CST1' . PHP_EOL );
		elseif ( $kwargs['arg'] == self::CST2 )
			print( 'arg is CST2' . PHP_EOL );
		else
			print( 'arg is not a class constant' . PHP_EOL );

		return;
	}

	public function __destruct() {
		print( 'Destructor called' . PHP_EOL );
		return;
	}
}

//
// avec les constantes, il n y pas de question de visibilite : il n y a pas de prive ou public . Donc il n y a pas 
// de raison de ne pas les utiliser a l exterieur de la classe
// je suis a l exterieur donc je n utilise pas self mais le nom de la classe Exemple_constant_de_class
// Exemple_constant_de_class::CST1 ==> je fais reference a CST1 qui se trouve dans la classe Exemple_constant_de_class
//
$instance1 = new Exemple_constant_de_class( array( 'arg' => Exemple_constant_de_class::CST1 ) ); 
$instance2 = new Exemple_constant_de_class( array( 'arg' => Exemple_constant_de_class::CST2 ) ); 
$instance2 = new Exemple_constant_de_class( array( 'arg' => 42 ) ); 

 */

Class Matrix {
	// convention : constantes en MAJUSCULE
	// ces variables NE SONT PAS DYNAMIQUES, elles seront tjrs les memes pour ttes les instances
	// et seront rattachees a la CLASSE et non l instance
	// elles ne vivent pas dans l instance
	// elles ne sont que dont le scope de la CLASSE
	const IDENTITY = 1;
	const SCALE = 2;
	const RX = 3;
	const RY = 4
	const RZ = 5;
	const TRANSLATION = 6;
	const PROJECTION = 7;

	//
	// Class attributes and methods
	//
	private static $_doc_file = "Matrix.doc.txt";
	public static $verbose = False;

	private static 	function _getDocFile() 	{ return self::$_doc_file; 			}
	private static 	function _setDocFile($f) { $self::$_doc_file = $f ; return;	}
	public static 	function getVerbose() 	{ return self::$verbose; 			}
	public static 	function setVerbose($v) { self::$verbose = $v; return; 		}
	//
	// Instance attributes and methods
	//
	// matrix coordinates
	private $_preset;
	private $_scale;
	private $_angle;
	private $_vtc;
	private $_fov;
	private $_ratio;
	private $_near;
	private $_far;

	private	function _getPreset() 		{ return $this->_x;					}
	private function _setPreset($x) 	{ $this->_x = $x ; return;			}
	private	function _getScale() 		{ return $this->_x;					}
	private function _setScale($x)	 	{ $this->_x = $x ; return;			}
	private	function _getAngle() 		{ return $this->_x;					}
	private function _setAngle($x)	 	{ $this->_x = $x ; return;			}
	private	function _getVtc() 			{ return $this->_x;					}
	private function _setVtc($x)	 	{ $this->_x = $x ; return;			}
	private	function _getFov() 			{ return $this->_x;					}
	private function _setFov($x)	 	{ $this->_x = $x ; return;			}
	private	function _getRatio() 		{ return $this->_x;					}
	private function _setRatio($x)	 	{ $this->_x = $x ; return;			}
	private	function _getNear() 		{ return $this->_x;					}
	private function _setNear($x)	 	{ $this->_x = $x ; return;			}
	private	function _getFar() 			{ return $this->_x;					}
	private function _setFar($x)	 	{ $this->_x = $x ; return;			}

	static function doc() {
		$doc = self::_getDocFile();
		if(($doc_content = @file_get_contents("$doc")) !== FALSE) {
			print($doc_content);
		} else {
			print('No documentation available - file: ' . '\'' . $doc . '\'' . ' doesnt exists.' . PHP_EOL);
		}
	}

	public function __construct( array $kwargs ) {
		if ( array_key_exists( 'preset', $kwargs ) ) {
			$this->_setPreset($kwargs['preset']);
		} else {
			// mandatory
			return(null);
		}
		if ( array_key_exists( 'scale', $kwargs ) ) {
			$this->_setScale($kwargs['scale']);
		} else {
			// mandatory if preset is set to SCALE
			if ($this->_getPreset == $self::SCALE) {
				return(null);
			}
		}
		if ( array_key_exists( 'angle', $kwargs ) ) {
			$this->_setAngle($kwargs['angle']);
		} else {
			// mandatory id preset is set to RX, RW, or RZ
			if (($this->_getPreset == $self::RX) ||
				($this->_getPreset == $self::RW) ||
				($this->_getPreset == $self::RZ) ) {
				return(null);
			}
		}
		if ( array_key_exists( 'vtc', $kwargs ) ) {
			$this->_setVtc($kwargs['vtc']);
		} else {
			// mandatory if preset is set to TRANSLATION
			if ($this->_getPreset == $self::TRANSLATION) {
				return(null);
			}
		}
		if ( array_key_exists( 'fov', $kwargs ) ) {
			$this->_setFov($kwargs['fov']);
		} else {
			// mandatory is preset is set to PROJECTION
			if ($this->_getPreset == $self::PROJECTION) {
				return(null);
			}
		}
		if ( array_key_exists( 'ratio', $kwargs ) ) {
			$this->_setRatio($kwargs['ratio']);
		} else {
			// mandatory is preset is set to PROJECTION
			if ($this->_getPreset == $self::PROJECTION) {
				return(null);
			}
		}
		if ( array_key_exists( 'near', $kwargs ) ) {
			$this->_setNear($kwargs['near']);
		} else {
			// mandatory is preset is set to PROJECTION
			if ($this->_getPreset == $self::PROJECTION) {
				return(null);
			}
		}
		if ( array_key_exists( 'far', $kwargs ) ) {
			$this->_setFar($kwargs['far']);
		} else {
			// mandatory is preset is set to PROJECTION
			if ($this->_getPreset == $self::PROJECTION) {
				return(null);
			}
		}

		if(self::getVerbose() === True) {
			print( $this . " constructed" . PHP_EOL);
		} else {
		}
	}

	public function __toString() {
		$x = $this->getX();
		$y = $this->getY();
		$z = $this->getZ();
		$w = $this->getW();
		if(self::getVerbose() === True) {
			$format = sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ", $x, $y, $z, $w);
			$format .= ')';
			return ($format);
		} else {
			return (sprintf("Vector( x: %.2f, y: %.2f, z:%.2f, w:%.2f )", $x, $y, $z, $w));
		}
	}

	public function __destruct() {
		if(self::getVerbose() === True) {
			print( $this . " destructed" . PHP_EOL);
		} else {
		}
		return;
	}

}
