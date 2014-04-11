<?php
class Priorite{
	private $id;
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	
	private $name;
	public function getName(){
		$this->name;
	}
	public function setName($name){
		$this->name = $name;
	}
	
	public function __construct($id, $name){
		$this->id = $id;
		$this->name = $name;
	}

}
?>