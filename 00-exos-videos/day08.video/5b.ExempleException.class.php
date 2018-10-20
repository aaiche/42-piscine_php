<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * 
 */
class AwesomeException extends Exception {

	public function __construct( $message = "", $code = 0, $previous = NULL ) {
		parent::__construct( $message, $code, $previous );
		print( 'AwesomeException constructed !' . PHP_EOL );
	}

	public function howIsThisException() {
		return 'Awesome';
	}
}

try {

	throw new AwesomeException( 'Towards infinity and beyond !', 42 );
	print( 'This line will never display.' . PHP_EOL );

} catch( Exception $exc ) {
	print( 'Got an exceptiion, Ma\'am !' . PHP_EOL );
	print( '$exc->howIsThisException(): ' . $exc->howIsThisException() . PHP_EOL );
	print( '$exc->getMessage(): ' . $exc->getMessage() . PHP_EOL );
	print( '$exc->getCode(): ' . $exc->getCode() . PHP_EOL );
	print( '$exc->getFile(): ' . $exc->getFile() . PHP_EOL );
	print( '$exc->getLine(): ' . $exc->getLine() . PHP_EOL );
	print( '$exc: ' . $exc . PHP_EOL );
}

// 

?>
