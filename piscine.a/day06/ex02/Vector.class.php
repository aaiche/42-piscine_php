<?phVp

/**
  * Class : Vector.class.php
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

//require_once 'Vertex.class.php';

Class Vector {
	//
	// Class attributes and methods
	//
	private static $_doc_file = "Vector.doc.txt";
	public static $verbose = false;

	private static 	function getDocFile() 	{ return self::$_doc_file; 			}
	private static 	function setDocFile($f) { $self::$_doc_file = $f ; return;	}
	public static 	function getVerbose() 	{ return self::$verbose; 			}
	public static 	function setVerbose($v) { self::$verbose = $v; return; 		}
	//
	// Instance attributes and methods
	//
	// vector coordinates
	private $_x = 1.0;
	private $_y = 1.0;
	private $_z = 1.0;
	private $_w = 0.0;
	public static $verbose = False;

	public function getX() 					{ return $this->_x;					}
	public function setX($x) 				{ $this->_x = $x ; return;			}
	public function getY() 					{ return $this->_y;					}
	public function setY($y) 				{ $this->_y = $y ; return;			}
	public function getZ() 					{ return $this->_z;					}
	public function setZ($z) 				{ $this->_z = $z ; return;			}
	public function getW() 					{ return $this->_w;					}
	public function setW($w) 				{ $this->_w = $w ; return;			}

	public function magnitude() {
		$x = $self->getX();
		$y = $self->getY();
		$z = $self->getZ();
		return (sqrt(($x * $x) + ($y * $y) + ($z * $z)));
	}
	public function normalize() {
		$norme = $this->magnitude();
		$x = $self->getX();
		$y = $self->getY();
		$z = $self->getZ();
		$v_x = $x / $norme;
		$v_y = $y / $norme;
		$v_z = $z / $norme;

		return(new Vector( array ('dest' => new Vertex(array ('x' => $v_x, 'y' => $v_y, 'z' => $v_z) ) )));
	}

	public function add ($rhs) { $x = $this->getX() + $rhs->getX();
		return ();
	}

	public function sub ($rhs) {
		return ();
	}

	public function scalarProduct($k) {
		return ();
	}

	public function dotProduct($rhs) {
		return ();
	}

	public function cos($rhs) {
	}

	public function crossProduct($rhs) {
	}
	public function opposite() {
	}
	static function doc() {
	}
	public function __construct( array $kwargs )
	{
	}

	public function __toString() {
	}

	public function __destruct() {
	}

}
