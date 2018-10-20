<?php

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

require_once 'Color.class.php';

Class Vector {
	//
	// Class attributes and methods
	//
	private static $_doc_file = "Vector.doc.txt";
	public static $verbose = False;

	private static 	function _getDocFile() 	{ return self::$_doc_file; 			}
	private static 	function _setDocFile($f) { $self::$_doc_file = $f ; return;	}
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
	private $_normalized = false;

	public 	function getX() 					{ return $this->_x;					}
	private function _setX($x) 					{ $this->_x = $x ; return;			}
	public 	function getY() 					{ return $this->_y;					}
	private function _setY($y) 					{ $this->_y = $y ; return;			}
	public 	function getZ() 					{ return $this->_z;					}
	private function _setZ($z) 					{ $this->_z = $z ; return;			}
	public 	function getW() 					{ return $this->_w;					}
	private function _setW($w) 					{ $this->_w = $w ; return;			}
	private function _getNormalize()			{ return $this->_normalized;		}
	private function _setNormalize($v)			{ $this->_normalized = $v; return;	}

	public function magnitude() {
		$x = $this->getX();
		$y = $this->getY();
		$z = $this->getZ();
		return ((sqrt(($x * $x) + ($y * $y) + ($z * $z))));
	}

	public function normalize() {
		if($this->_getNormalize() === False) {
			$vector_length = $this->magnitude();
			$x = $this->getX();
			$y = $this->getY();
			$z = $this->getZ();

			// 
			// verifier que le vecteur n est pas nul
			//
			if($vector_length != 0) {
				$x_normalized = $x / $vector_length;
				$y_normalized = $y / $vector_length;
				$z_normalized = $z / $vector_length;
				//cf. sujet: c est confus
				//$this->_setX($x_normalized);
				//$this->_setW($y_normalized);
				//$this->_setZ($z_normalized);
				//$this->_setNormalize('True');

				$vertex_dest = new Vertex( array( 'x' => $x_normalized, 'y' => $y_normalized, 'z' => $z_normalized ) );
				$output_vector = new Vector( array( 'dest' => $vertex_dest ) );
				return($output_vector);
			} else {
				return(null);
			}
		} else {
			/* ?? retourne une copie fraiche du vecteur. */
			/* vertex orgin will be the default */
			$vertex_dest = new Vertex( array( 'x' => $x_normalized, 'y' => $y_normalized, 'z' => $z_normalized ) );
			$output_vector = new Vector( array( 'dest' => $vertex_dest ) );
			return($output_vector);
		}
	}

	public function add(Vector $rhs) { 
		$x = $this->getX() + $rhs->getX();
		$y = $this->getY() + $rhs->getY();
		$z = $this->getZ() + $rhs->getZ();
		$vertex_dest = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z ) );
		$output_vector = new Vector( array( 'dest' => $vertex_dest ) );
		return($output_vector);
	}

	public function sub(Vector $rhs) {
		$x = $this->getX() - $rhs->getX();
		$y = $this->getY() - $rhs->getY();
		$z = $this->getZ() - $rhs->getZ();
		$vertex_dest = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z ) );
		$output_vector = new Vector( array( 'dest' => $vertex_dest ) );
		return($output_vector);
	}

	public function opposite() {
		return($this->scalarProduct(-1));
	}

	public function scalarProduct($k) {
		$x = $k * $this->getX();
		$y = $k * $this->getY();
		$z = $k * $this->getZ();
		$vertex_dest = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z ) );
		$output_vector = new Vector( array( 'dest' => $vertex_dest ) );
		return($output_vector);
	}

	public function dotProduct($rhs) {
		/* dans un repere quelconque */
		/* produit scalaire = u * v = 1/2 [ ||u + v||^2  - ||u||^2 - ||v||^2] */
		/* produit scalaire = u * v = ||u|| x ||v|| * cos(u,v) */
		/*
		$sum = $this->add($rhs);	// a corriger car fait du new
		$sum_length = $sum->magnitude();
		$u_length = $this->magnitude();
		$v_length = $rhs->magnitude();
		$scalar_product_output = (float)(1/2 * ( $sum_length*$sum_length - ($u_length*$u_length) -($v_length*$v_length)));
		 */
	
		/* dans un repere orthonorme*/
		/* produit scalaire = u * v = x1x2 + y1y2 + z1z2
		/* produit scalaire = u * v = ||u|| x ||v|| * cos(u,v) */
		$x = $this->getX();
		$y = $this->getY();
		$z = $this->getZ();

		$r_x = $rhs->getX();
		$r_y = $rhs->getY();
		$r_z = $rhs->getZ();
		$scalar_product_output = (float)($x * $r_x + $y * $r_y + $z * $r_z);

		return ($scalar_product_output);
	}

	public function cos(Vector $rhs) {
		/* produit scalaire = u * v = x1x2 + y1y2 + z1z2
		/* produit scalaire = u * v = ||u|| x ||v|| * cos(u,v) */
		$dot_product = $this->dotProduct($rhs);
		$u_length = $this->magnitude();
		$v_length = $rhs->magnitude();

		$cos_output = $dot_product / ($u_length * $v_length);
		return ($cos_output);

	}

	public function crossProduct($rhs) {
		/*
		 * 		i	j	k
		 * u : (x1, y1, z1)
		 * v : (x2, y2, z2)
		 *
		 * u ^ v = 	i . (y1z2 - y2z1)	- 	j.(x1z2 - x2z1)		+ k.(x1y2-x2y1)
		 */
		$x1 = $this->getX();
		$y1 = $this->getY();
		$z1 = $this->getZ();
		
		$x2 = $rhs->getX();
		$y2 = $rhs->getY();
		$z2 = $rhs->getZ();
		
		$x = $y1 * $z2 - $y2 * $z1;
		$y = $x2 * $z1 - $x1 * $z2;
		$z = $x1 * $y2 - $x2 * $y1;

		$vertex_dest = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z ) );
		$output_vector = new Vector( array( 'dest' => $vertex_dest ) );
		return($output_vector);
	}

	static function doc() {
		$doc = self::_getDocFile();
		if(($doc_content = @file_get_contents("$doc")) !== FALSE) {
			print($doc_content);
		} else {
			print('No documentation available - file: ' . '\'' . $doc . '\'' . ' doesnt exists.' . PHP_EOL);
		}
	}

	private function _setVectorCoordinates(Vertex $dest, Vertex $orig) {
		/* les coordoonnees du vecteur: destination - origine */
		$this->_setX($dest->getX() - $orig->getX());
		$this->_setY($dest->getY() - $orig->getY());
		$this->_setZ($dest->getZ() - $orig->getZ());
		$this->_setW(0);
	}
	public function __construct( array $kwargs ) {
		if( (count($kwargs) == 2) 
			&& array_key_exists('dest', $kwargs) 
			&& array_key_exists('orig', $kwargs) 
			&& ($kwargs['dest'] instanceof Vertex)
			&& ($kwargs['orig'] instanceof Vertex)	) {
				/* les coordoonnees du vecteur: destination - origine */
				$dest = $kwargs['dest'];
				$orig = $kwargs['orig'];
				$this->_setVectorCoordinates($dest, $orig);

		} elseif( (count($kwargs) == 1) 
			&& array_key_exists('dest', $kwargs) 
			&& ($kwargs['dest'] instanceof Vertex) ) {

				$dest = $kwargs['dest'];
				$orig_default = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1 ) );
				$this->_setVectorCoordinates($dest, $orig_default);
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
	}

	public function __toString() {
		//echo "djsakjaksjdlksjlkdjal\n";
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
