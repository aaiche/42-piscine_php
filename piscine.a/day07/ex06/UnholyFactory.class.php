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
?>
