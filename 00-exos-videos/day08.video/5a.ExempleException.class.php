<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * 
 */
try {

	throw new Exception( 'Towards infinity and beyond !', 42 );
	print( 'This line will never display.' . PHP_EOL );

} catch( Exception $exc ) {
	print( 'Got an exceptiion, Ma\'am !' . PHP_EOL );
	print( '$exc->getMessage(): ' . $exc->getMessage() . PHP_EOL );
	print( '$exc->getCode(): ' . $exc->getCode() . PHP_EOL );
	print( '$exc->getFile(): ' . $exc->getFile() . PHP_EOL );
	print( '$exc->getLine(): ' . $exc->getLine() . PHP_EOL );
	print( '$exc: ' . $exc . PHP_EOL );
}

// 

?>
