<?php
/**
  * Class : IFighter.class.php
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
 * 		| Jon Snow     |         | Maester Aemon|	| Samwell Tarly |	|         |         |               |
 * 		 -------------- 	 	  --------------	 ---------------	 ---------           ---------------
 */ 	
/*
 * classe interface : la relation d heritage est differente, php introduit un nouveau vocabulaire
 * 		- on NE va PAS dire que Fille est une classe Mere,
 * 		mais
 * 		- Fille  implemente une interface
 *	une interface est une classe:
 *		- qui est abstraite
 *		- qui ne contient que des methodes abstraites
 *		- qui ne contient pas d attributs
 *		- on peut y trouver des constantes
 *	Si les conditions ci-dessous sont respectees, on ne parlera plus de classe abstraite mais de INTERFACE
 */

// interface Mere
// par convention on met I devant le nom de la classe
// interface == abstract class
interface  IFighter {
	// code vide
	// pas de mot abstract devant la  methode
	// par defaut ttes les methodes dans une interface sont abstraites
	public function fight();
}
?>
