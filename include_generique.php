<?php

class ModuleGenerique {
	protected $titre;
	/** @var ControleurGenerique */
	protected $controleur;


	public function getTitre() {
		return $this->titre;
	}

	public function display() {
		$this->controleur->display();
	}
}


class ControleurGenerique {
	protected $classeVue;
	protected $fonctionVue;
	protected $paramsFonctionVue;
	protected $titre;


	public function display() {
		call_user_func_array(array($this->classeVue, $this->fonctionVue), $this->paramsFonctionVue);
	}

	public function constructView($classe, $fonction, array $tableauParams) {
		if (is_array($tableauParams)) {
			$this->classeVue = $classe;
			$this->fonctionVue = $fonction;
			$this->paramsFonctionVue = $tableauParams;
		}
	}

	public function getTitre() {
		return $this->titre;
	}
}



