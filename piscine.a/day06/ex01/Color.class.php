<?php
/**
  * Class : Color.class.php
  * 
  *	Description:
  *
  * Available options:
  *
  * @param 	array	$parameters	An associative array of initilisation parameters
  * 							$parmaters might be 
  * 								- ('rgb' => value)
  * 								- ('red' => value, 'green' => value, 'blue' => value)
  * @param 
  * 
  * @return 
  * 
  * @throws ...
  * 
  * @version 0.1.0
  */

Class Color {
	//
	// Class attributes and methods
	//
	private static $_doc_file = "Color.doc.txt";
	public static $verbose = false;

	private static 	function getDocFile() 	{ return self::$_doc_file; 			}
	private static 	function setDocFile($f) { $self::$_doc_file = $f ; return;	}
	public static 	function getVerbose() 	{ 
		/*
		// ??TBD?? : how can we check that it is a boolean value and wht to do if not !!
		if(is_bool(self::$verbose)) {
			//print('is iboolean' . PHP_EOL);
		} else {
			//print('is NOT boolean' . PHP_EOL);
		}
		if( self::$verbose === True ) {
			//print('is set' . PHP_EOL);
			return true;
		} else {
			//print('is not set' . PHP_EOL);
			return false;
		}
		 */
		return self::$verbose;
	}
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
	public $red;
	public $green;
	public $blue;
	public $rgb;

	// ??TBD?? as per class documentation : not checking if the values are in the 0..255 range
	public function getRed() 	{ return $this->red;			}
	public function setRed($r)  { $this->red = 	$r; 	return;	} 
	public function getGreen() 	{ return $this->green; 			}
	public function setGreen($g){ $this->green = 	$g; return;	} 
	public function getBlue() 	{ return $this->blue; 			}
	public function setBlue($b) { $this->blue = 	$b; return;	} 
	public function getRgb() 	{ return $this->rgb; 			}
	public function setRgb($rgb){ $this->rgb = 	$rgb; 	return;	} 
	
	//
	// Used also when verbose
	//
	public function __toString() {
		$red = $this->getRed();
		$green = $this->getGreen();
		$blue = $this->getBlue();
		return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", $red, $green, $blue));
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
		if( (count($kwargs) == 1) && array_key_exists('rgb', $kwargs) ) {
				$this->setRgb($kwargs['rgb']);
				$this->setRed(($this->getRgb() >> 16) & 0xff);
				$this->setGreen(($this->getRgb() >> 8) & 0xff);
				$this->setBlue($this->getRgb() & 0xff);
		} elseif( (count($kwargs) == 3) 
			&& array_key_exists('red', $kwargs) 
			&& array_key_exists('green', $kwargs) 
			&& array_key_exists('blue', $kwargs) ) {
				$this->setRed($kwargs['red']);
				$this->setGreen($kwargs['green']);
				$this->setBlue($kwargs['blue']);
				$this->setRgb(($this->getRed() << 16 | $this->getGreen() << 8 | $this->getBlue()));
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
			print( $this . " constructed." . PHP_EOL);
		} else {
		}

		return;
	}

	public function add(Color $color_to_add) {
		/*
		 * ?? TBD??
		 * throw or catch the exceptio
		if(is_empty($color)) {
		}
		 */
		$new_color = new Color( 
			array(
				'red' => $this->getRed() + $color_to_add->getRed(),
				'green' => $this->getGreen() + $color_to_add->getGreen(),
				'blue' => $this->getBlue() + $color_to_add->getBlue()
			)
		);
		return $new_color;
	}

	public function sub(Color $color_to_sub) {
		$new_color = new Color( 
			array(
				'red' => $this->getRed() - $color_to_sub->getRed(),
				'green' => $this->getGreen() - $color_to_sub->getGreen(),
				'blue' => $this->getBlue() - $color_to_sub->getBlue()
			)
		);
		return $new_color;
	}

	public function mult($color_factor)
	{
		if(is_numeric($color_factor)) {
			$new_color = new Color( 
				array(
					'red' => $this->getRed() * $color_factor,
					'green' => $this->getGreen() * $color_factor,
					'blue' => $this->getBlue() * $color_factor
				)
			);
			return $new_color;
		} else {
			// ?/
		}
	}

	public function __destruct() {
		if(self::getVerbose() === True) {
			print( $this . " destructed." . PHP_EOL);
		} else {
		}
		return;
	}
}
?>
