<?php
/**
  * Class : Vertex.class.php
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
  * 								- ('w' => value)		==> optional default to 1.0
  * 								- ('color' => value)	==> optional default to white
  * @param 
  * 
  * @return 
  * 
  * @throws ...
  * 
  * @version 0.1.0
  */

Class Vertex {
	//
	// Class attributes and methods
	//
	private static $_doc_file = "Vertex.doc.txt";
	public static $verbose = false;

	private static 	function getDocFile() 	{ return self::$_doc_file; 			}
	private static 	function setDocFile($f) { $self::$_doc_file = $f ; return;	}
	public static 	function getVerbose() 	{ return self::$verbose; 			}
	public static 	function setVerbose($v) { self::$verbose = $v; return; 		}


	/*
	public function __get($doc_file) {
		print( 'Attempt to access \'' . $doc_file . '\' attribute, this script should die' . PHP_EOL );
		return 'arrrg';
	}
	public function __set($doc_file, $value ) {
		print( 'Attempt to set \'' . $doc_file . '\' attribute to \'' . $value . '\', this script should die' . PHP_EOL );
		return;
	}
	// ??TBD?? how to check the value set on verbose
	public function __set($verbose, $value ) {
		print( 'Attempt to set \'' . $doc_file . '\' attribute to \'' . $value . '\', this script should die' . PHP_EOL );
		return;
	}
	 */

	//
	// Instance attributes and methods
	//
	// a point is represented by the following coordinates
	private	$_x;
	private	$_y;
	private	$_z;
	private	$_w;
	// ??TBD?? why we could not set the default color here ??
	private	$_color;

	public function getX() 					{ return $this->_x;					}
	public function setX($x) 				{ $this->_x = $x ; return;			}
	public function getY() 					{ return $this->_y;					}
	public function setY($y) 				{ $this->_y = $y ; return;			}
	public function getZ() 					{ return $this->_z;					}
	public function setZ($z) 				{ $this->_z = $z ; return;			}
	public function getW() 					{ return $this->_w;					}
	public function setW($w) 				{ $this->_w = $w ; return;			}
	public function getColor()				{ return $this->_color;				}
	public function setColor(Color $color)	{ $this->_color = $color; return;	}

	//
	// Used also when verbose
	//
	public function __toString() {
		$x = $this->getX();
		$y = $this->getY();
		$z = $this->getZ();
		$w = $this->getW();
		$color = $this->getColor();
		if(self::getVerbose() === True) {
			$format = sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, ", $x, $y, $z, $w);
			$format .= $color . ' )';
			return ($format);
		} else {
			return (sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )", $x, $y, $z, $w));
		}
	}
	
	//
	// doc() displays the contents of the doc file
	//
	public static function doc() {
		$doc = self::getDocFile();
		if(($doc_content = @file_get_contents("$doc")) !== FALSE) {
			//print($doc_content . PHP_EOL);
			print($doc_content);
		} else {
			print('No documentation available - file: ' . '\'' . $doc . '\'' . ' doesnt exists.' . PHP_EOL);
		}
	}

	public function __construct( array $kwargs ) {
		//print( 'Constructor called' . PHP_EOL );
		// !!! there must a better way to check the names of the keys !!!
		//print( 'count= ' . count($kwargs) . PHP_EOL);
		if( (count($kwargs) == 5) 
			&& array_key_exists('x', $kwargs) 
			&& array_key_exists('y', $kwargs) 
			&& array_key_exists('z', $kwargs) 
			&& array_key_exists('w', $kwargs) 
			&& array_key_exists('color', $kwargs) ) {
				$this->setX($kwargs['x']);
				$this->setY($kwargs['y']);
				$this->setZ($kwargs['z']);
				$this->setW($kwargs['w']);
				$this->setColor($kwargs['color']);
		} elseif( (count($kwargs) == 4) 
			&& array_key_exists('x', $kwargs) 
			&& array_key_exists('y', $kwargs) 
			&& array_key_exists('z', $kwargs) 
			&& array_key_exists('w', $kwargs) ) {
				$this->setX($kwargs['x']);
				$this->setY($kwargs['y']);
				$this->setZ($kwargs['z']);
				$this->setW($kwargs['w']);
				$color_default = new Color( array( 'rgb' => 0xffffff ) );
				$this->setColor($color_default);
		} elseif( (count($kwargs) == 4) 
			&& array_key_exists('x', $kwargs) 
			&& array_key_exists('y', $kwargs) 
			&& array_key_exists('z', $kwargs) 
			&& array_key_exists('color', $kwargs) ) {
				$this->setX($kwargs['x']);
				$this->setY($kwargs['y']);
				$this->setZ($kwargs['z']);
				$this->setW(1.0);
				$this->setColor($kwargs['color']);
		} elseif( (count($kwargs) == 3) 
			&& array_key_exists('x', $kwargs) 
			&& array_key_exists('y', $kwargs) 
			&& array_key_exists('z', $kwargs) ) {
				$this->setX($kwargs['x']);
				$this->setY($kwargs['y']);
				$this->setZ($kwargs['z']);
				$this->setW(1.0);
				$color_default = new Color( array( 'rgb' => 0xffffff ) );
				$this->setColor($color_default);
		} else {
			// invalid arguments
			// will be nice if we can display all the input arguments
			// print('invalid arguments names or values: ' . implode(",", $kwargs) . PHP_EOL);
			//
			print('invalid arguments' . PHP_EOL);
			//
			//we should throw an Exception here
			//
			exit(-1);
		}
		if(self::getVerbose() === True) {
			print( $this . " constructed" . PHP_EOL);
		} else {
		}

		return;
	}

	public function __destruct() {
		if(self::getVerbose() === True) {
			print( $this . " destructed" . PHP_EOL);
		} else {
		}
		return;
	}
}
?>
