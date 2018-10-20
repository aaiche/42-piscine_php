<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * on rassemble des comportements dans un trait
 * on peut aussi mettre des attributs
 */
trait JsonSerializer {
	
	public function serializeJson( array $dict ) {
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
}

trait HTMLSerializer {
	public function serializeHTML( array $dict ) {
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

Class ExampleA {

	// quel specificite/comportement ma classe va avoir
	use JsonSerializer, HTMLSerializer {
		// on resout les conflits
		// je declare un alias . Je cree serialize() par alias
		serializeJson as serialize;
   	}

	public function __construct( array $kwargs ) {
		print( 'Constructor of ExempleA called' . PHP_EOL );
		$this->serialize( $kwargs );
		return;
	}

	public function __destruct() {
		print( 'Destructor ExempleA called' . PHP_EOL );
		return;
	}
	
}

Class ExampleB {

}


// 
$dict = array("key1" => "val1", "key2" => "val2", "key3" => "val3");
$instance = new ExampleA($dict);

?>
