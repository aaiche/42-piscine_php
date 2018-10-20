<?php
/**
  * Class : UnholyFactory.class.php
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


class UnholyFactory {
	private $_enrolled_fighters = [];

	private function _getEnrolledFighters() 	{ return $this->_enrolled_fighters; 					}
	private function _setEnrolledFighters($p)	{ array_push($this->_enrolled_fighters, $p); return;	}

	private function _isAleadyEnrolled($p) {
		if(in_array($p, $this->_getEnrolledFighters())) {
			return True;
		} else {
			return False;
		}
	}

	/*
	 * On engage que les 'fighters' donc 
	 * - on verifie si les 'Filles' sont (ont herite de) des classes Fighter, sinon 
	 *   on dit : "(Factory can't absorb this, it's not a fighter)"
	 * - si les 'Filles' sont des Fighter alors on regarde si on a deja des fighters de ce type
	 *   si on a pas ce type de Fighter, on dit : "(Factory absorbed a fighter of type xxxx)"
	 *   sinon on dit "(Factory already absorbed a fighter of type xxxx)" si on l a deja
	 *
	 */
	public function absorb($p) {
		if($p instanceof Fighter) {
			if ( $this->_isAleadyEnrolled($p) ) {
				print( '(Factory already absorbed a fighter of type ' . $p . ')' . PHP_EOL );
			} else {
				$this->_setEnrolledFighters($p);
				print( '(Factory absorbed a fighter of type ' . $p . ')' . PHP_EOL );
			}
		} else {
			// person is not a fighter: can not enrol it
			print( "(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
		}
	}

	/*
	 * Il s agit de fabriquer des soldats-->message "(Factory fabricates a fighter of type foot soldier)"
	 * Mais on doit avoir deja fabrique des soldats de ce type pour pouvoir les cloner
	 */
	public function fabricate($p) {
		foreach ($this->_getEnrolledFighters() as $fighter) {
			if ($fighter->getFighterType() === $p) {
				print( "(Factory fabricates a fighter of type " . $fighter . ")" . PHP_EOL );
				return clone $fighter;
			}
		}
		print( "(Factory hasn't absorbed any fighter of type " . $p . ")" . PHP_EOL );
		return null;
	}
}

/*
 *
 * Dans test1.php, on fabrique 7 soldats:
 *
 *		$requested_fighters = Array(
 *			"foot soldier",
 *			"llama",				--> n est pas fabrique car c est un soldat
 *			"foot soldier",
 *			"archer",
 *			"foot soldier",
 *			"assassin",
 *			"foot soldier",
 *			"archer",
 *		);
 *
 * on fait appel a la methode obligatoire fight() pour tous les soldats pour les targets "the Hound", "Tyrion", et "Podrick"
 *   foot soldier::fight()
 *			public function fight($target) {
 *				print ("* draws his sword and runs towards " . $target . " *" . PHP_EOL);
 *			}
 *   		* draws his sword and runs towards the Hound *
 *			* draws his sword and runs towards Tyrion *
 *			* draws his sword and runs towards Podrick *
 *
 *   foot soldier::fight()
 *			* draws his sword and runs towards the Hound *
 *			* draws his sword and runs towards Tyrion *
 *			* draws his sword and runs towards Podrick *
 *
 *   archer::fight()
 *			public function fight($target) {
 *				print ("* shoots arrows at " . $target . " *" . PHP_EOL);
 *			}
 *			* shoots arrows at the Hound *
 *			* shoots arrows at Tyrion *
 *			* shoots arrows at Podrick *
 *
 *   soldier::fight()
 *			* draws his sword and runs towards the Hound *
 *			* draws his sword and runs towards Tyrion *
 *			* draws his sword and runs towards Podrick *
 *
 *   assassin::fight()
 *			public function fight($target) {
 *				print ("* creeps behind " . $target . " and stabs at it *" . PHP_EOL);
 *			}
 *			* creeps behind the Hound and stabs at it *
 *			* creeps behind Tyrion and stabs at it *
 *			* creeps behind Podrick and stabs at it *
 *
 *   foot soldier::fight()
 *			* draws his sword and runs towards the Hound *
 *			* draws his sword and runs towards Tyrion *
 *			* draws his sword and runs towards Podrick *
 *
 *   archer::fight()
 *			* shoots arrows at the Hound *
 *			* shoots arrows at Tyrion *
 *			* shoots arrows at Podrick *
 */
?>
