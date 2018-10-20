<?php
/**
  * Class : Fighter.class.php
  * 
  *	Description:
  *
  * Available options:
  *
  * @param 	
  * @param 
  * 
  * @return 
  * 
  * @throws ...
  * 
  * @version 0.1.0
  */
/*
 * 						 -----------------------
 * 						|	Continent Westeros  |
 * 						 -----------------------
 * 									|
 * 									|
 *			     -------------------------------------------
 * 				|					|						|
 * 				|					|						|
 * 				|					|						|
 * 		 --------------	  	 	  --------------	 -----------		 --------            ---------------
 * 		| House Stark  |         | House Martell|	| Lannister |   	| Greyjoy |         | Night's Watch |
 * 		 -------------- 	 	  --------------	 -----------		 ---------           ---------------
 * 		 																							|
 * 		 																							|
 * 		 																							|
 * 		 																							|
 * 		 																							|
 *			     ------------------------------------------------------------------------------------------------------
 * 				|					|						|				|						|
 * 				|					|						|				|						|
 * 				|					|						|				|						|
 * 		 --------------	  	 	  --------------	 --------------		 --------            ---------------
 * 		| Footsoldier  |         | Archer       |	| Assassin      |	|         |         |               |
 * 		 -------------- 	 	  --------------	 ---------------	 ---------           ---------------
 *
 *
 *
 * 		 -------------------	  	   --------------	 --------------		 --------            ---------------
 * 		| Crippled Soldier  |         | llama        |	|               |	|         |         |               |
 * 		 ------------------- 	 	   --------------	 ---------------	 ---------           ---------------
 */

abstract class Fighter {
	private $fighter_type;

	public function getFighterType() 	{ return $this->fighter_type; 		}
	public function setFighterType($n)	{ $this->fighter_type = $n; return;	}

	public function __construct($n) {
		$this->setFighterType($n);
	}

	/* Fille doit implementer la fonction fight() AVEC UN ARGUMENT de ce type sinon erreur fatal*/
	public abstract function fight($target);

	public function __toString() {
		return $this->getFighterType();
	}
	
	// 
	// instance dupliquee en memoire et chacune vit sa vie. et je ne veux pas reconstuire l instance
	// 
	/*
	 * activer si l on souhaite qd on est clone
	 */
	/*
	public function __clone() {
		print( 'Clone called: on me clone' . PHP_EOL );
		return;
	}
	 */
}
?>
