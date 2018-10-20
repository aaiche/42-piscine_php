<?php 
	class Human {
		protected	$nom;
		protected	$x = 0;

		public function __construct($prenom) {
			$this->nom = $prenom;
		}

		public function getNom() {
			return $this->nom;
		}

		public function enAvant() {
			$this->x += 1;
			echo $this->nom . ' avance d\'une case' .  'Maintenant en position ' . $this->x . '<br>';
			return $this;
		}


		//+ defintion de methodes specifiques...
	}
?>
