<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * Serialiser des donnees vers du json ou du html
 */
Class ExampleA {

	public function __construct( array $kwargs ) {
		print( 'Constructor of ExempleA called' . PHP_EOL );
		$this->dumpJson( $kwargs );
		$this->dumpHTML( $kwargs );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleA called' . PHP_EOL );
		return;
	}
	
	public function dumpJson( array $dict ) {
		print( '           ===> ExampleA: Function dumpJson()' . PHP_EOL );
		end( $dict );				// on se positiionne sur le dernier couple cle:valeur
		$last = key( $dict );		// last key
		print( '{' . PHP_EOL );
		foreach( $dict as $k => $v ) {
			if( $k !== $last ) {
				printf( "\t\"%s\": \"%s\",%s", $k, $v, PHP_EOL );
			} else {
				printf( "\t\"%s\": \"%s\"%s", $k, $v, PHP_EOL );
			}
		}
		print( '}' . PHP_EOL );

		return;
	}

	public function dumpHTML( array $dict ) {
		print( '           ===> ExampleA: Function dumpHTML()' . PHP_EOL );
		echo <<<END
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Dump HTML</title>
	<head>
	<body>
		<dl>

END;

		foreach( $dict as $k => $v ) {
			echo "\t\t\t<dt>$k</dt>" . PHP_EOL;
			echo "\t\t\t<dd>$v</dd>" . PHP_EOL;
		}

		echo <<<END
		</dl>
	</body>
</html>

END;

		return;
	}
}

Class ExampleB {

	public function __construct( array $kwargs ) {
		print( 'Constructor of ExempleB called' . PHP_EOL );
		$this->dumpJson( $kwargs );
		$this->dumpHTML( $kwargs );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleB called' . PHP_EOL );
		return;
	}
	
	public function dumpJson( array $dict ) {
		print( '           ===> ExampleB: Function dumpJson()' . PHP_EOL );
		end( $dict );				// on se positiionne sur le dernier couple cle:valeur
		$last = key( $dict );		// last key
		print( '{' . PHP_EOL );
		foreach( $dict as $k => $v ) {
			if( $k !== $last ) {
				printf( "\t\"%s\": \"%s\",%s", $k, $v, PHP_EOL );
			} else {
				printf( "\t\"%s\": \"%s\"%s", $k, $v, PHP_EOL );
			}
		}
		print( '}' . PHP_EOL );

		return;
	}

	public function dumpHTML( array $dict ) {
		print( '           ===> ExampleB: Function dumpHTML()' . PHP_EOL );
		echo <<<END
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Dump HTML</title>
	<head>
	<body>
		<dl>

END;

		foreach( $dict as $k => $v ) {
			echo "\t\t\t<dt>$k</dt>" . PHP_EOL;
			echo "\t\t\t<dd>$v</dd>" . PHP_EOL;
		}

		echo <<<END
		</dl>
	</body>
</html>

END;

		return;
	}
}


// 
$dict = array("key1" => "val1", "key2" => "val2", "key3" => "val3");
$instance = new ExampleA($dict);


?>
