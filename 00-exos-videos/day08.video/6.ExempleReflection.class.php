<?php
/* ************************************************************************** */
/* Example.class.php                                                          */
/* ************************************************************************** */

/*
 * 
 */
class ExampleReflection {

	const		GA = 0;
	const		BU = 1;
	const		ZO = 2;

	public		$publicAtt = 21;
	protected	$_protectedAtt = 84;
	private		$_privateAtt = 42;

	public function __construct() {
		print( 'Constructor ExampleReflection called' . PHP_EOL );
	}

	public function __destruct() {
		print( 'Destructor ExampleReflection called' . PHP_EOL );
	}

	public function publicFoo() {
		print( 'Function publicFoo() from class ExampleReflection' . PHP_EOL );
	}

	protected function _protectedFoo() {
		print( 'Function _protectedFoo() from class ExampleReflection' . PHP_EOL );
	}

	private function _privateFoo() {
		print( 'Function _privateFoo() from class ExampleReflection' . PHP_EOL );
	}
}

// 
$instance = new ExampleReflection();

$classExampleReflection = new ReflectionClass( 'ExampleReflection' );
$alsoClassExampleReflection = new ReflectionObject( $instance );

print( 'Class Name ' . $classExampleReflection->getName() . ':' . PHP_EOL );
print_r( $classExampleReflection->getConstants() );
print_r( $classExampleReflection->getProperties() );
print_r( $classExampleReflection->getMethods() );

print( 'Class Name ' . $alsoClassExampleReflection->getName() . ':' . PHP_EOL );
print_r( $alsoClassExampleReflection->getConstants() );
print_r( $alsoClassExampleReflection->getProperties() );
print_r( $alsoClassExampleReflection->getMethods() );

?>
