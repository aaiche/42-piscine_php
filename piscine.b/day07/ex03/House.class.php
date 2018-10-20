<?php
/**
  * Class : House.class.php
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
 * 		 --------------	  	 	  --------------	 -----------		 --------
 * 		| House Stark  |         | House Martell|	| Lannister |   	| Greyjoy |
 * 		 -------------- 	 	  --------------	 -----------		 ---------
 */ 	

/*
 * classe abstraite: interdiction de l instancier
 *
 * Il peut etre tt a fait  pertinent de regrouper au sein d une classe des comportements qui allaient
 * etre utiles une fois specialise, mais en soi ne servaient a rien. Par exple, on pourrait avoir une
 * classe qui pourra definir des comportements de base pour un personnage et que les classes specialisees
 * vont etre un guerrier, un mage, ... et que les classes Filles vont veritablement faire le travail et que
 * finalement tout ce qu on va trouver dans la classe Mere ce sont des donnees generales mais qui n ont pas
 * d interet en elles meme, c-a-d instancier une classe n a pas de sens
 * A force de travaiiler dans cette direction, certains langages ont fait le choix de proposer une syntaxe qui permet 
 * d interdire explicitement d instancier une classe
 */
abstract class House {

	/* 
	 * Dans une classe abstraite: j ai aussi le droit de declarer des methodes abstraites
	 * Elles seront obligatoirement implementees par les Filles
	 * On veut que les Filles aient ce comportement
	 */
	abstract public function getHouseName();
	abstract public function getHouseMotto();
	abstract public function getHouseSeat();

	/* n a aucun sens ici: car on pourra pas l instancier a moins de l utiliser dans la classe Fille parent:: mais c est a tester*/
	/* ==> Finalement teste alors cela peut avoir du sens */
	/*
	public function __construct() {
		print( 'Constructor Mere called' . PHP_EOL );
		return;
	}
	 */


	/* n a aucun sens ici: car on pourra pas l instancier */
	/*
	public function __destruct() {
		return;
	}
	 */
	
	/* code: on ne pourra l utiliser uniquement que lors de l heritage */
	/* comme les Filles vont implenter ces 3 methodes, elles peuvent dynamiquement utiliser les leurs */
	/* Ici je ne comprends pas pourquoi on ne peut pas utiliser $this */
	public function introduce() {
		$str_out = 'House ';
		$str_out .= static::getHouseName();
		$str_out .= ' of ';
		$str_out .= static::getHouseSeat();
		$str_out .= ' : "';
		$str_out .= static::getHouseMotto();
		$str_out .= '"';
		$str_out .= PHP_EOL;
		print( $str_out );
	}
}
?>
