<?php
/**
  * Class : Greyjoy.class.php
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
 * Visibilite VERTICALE
 * heritage: on introduit une relation verticale entre 2 classes. Cela signifie que la question de visibilite
 * se pose a nouveau. Sachant que l on a des attributs/methodes prives ou publics et on sait comment cela fonctionne
 * de l exterieur, MAIS Q EN EST T IL entre une classe Mere et une classe Fille
 *
 * Dans la classe Fille, on est considere comme a l exterieur de la classe Mere
 * 		- Tout ce qui est PRIVE dans la classe Mere le reste.
 * 		  La classe fille NE POURRA PAS ACCEDER a ce qui est prive dans la classe Mere
 * 		- Tout ce qui est PUBLIC dans la classe Mere le reste. Fille pourra y acceder
 *
 * Mais cela pose un probleme: si on herite d une classe, cela veut dire que l on veut etendre ces fonctionnalites. C est le boulot
 * du developpeur et on est pas a l exterieur de la classe Mere. Donc on aimerait bien pouvoir acceder aux donnees de la classe Mere.
 * C est pourquoi dans tous les langages, on introduit un 3 eme mot cle PROTCTED qui va se situer entre le Prive et le Public
 *
 * Les regles sont les suivantes:
 * 	- a l exterieur de la classe, Protected a le meme comportement que le Prive. Tout ce qui est protected 
 * 	n est pas accessible depuis l extexterieur de la classe
 * 	- a l interieur de la classe Fille, Protected sera accessible 
 */

/*
 * 						 -----------------------
 * 						|	House Greyjoy   	|
 * 						 -----------------------
 * 									|
 * 									|
 *			     -------------------------------------------
 * 				|					|						|
 * 				|					|						|
 * 				|					|						|
 * 		                  	 	  --------------
 * 		                         | Gars Euron   |
 * 		                 		  --------------	
 */ 	



//
// Greyjoy est une classe une classe Mere pour Euron
// Euron Herite de Geyjoy et aura acces a tt ce qui est protected aussi mais uniquement dans la classe
// C est comme si dans class Euron extends {
//                           private $familyMotto;
//						}
Class Greyjoy {

	// sera accessible par la Fille mais ne sera pas accessible de l exterieur
	protected $familyMotto = 'We do not sow';		/* nous nous semons pas*/

	/*
	public function __construct() {
		return;
	}
	*/

	/*
	 *  on peut initialiser familyMotto ici, car cette methode sera appelee par Euro qui n en a pas
	 */
	/*
	public function __destruct() {
		return;
	}
	 */
}
?>
