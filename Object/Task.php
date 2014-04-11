<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "\FollowMeGit\data\SqlFunction.php";

class Task{
	
	private $id;
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	
	private $name;
	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name = $name;
	}
	
	private $statut;
	public function getStatut(){
		return $this->statut;
	}
	public function setStatut($statut){
		$this->statut = $statut;
	}
	
	private $priorite;
	public function getPriorite(){
		return $this->priorite;
	}
	public function setPriorite(){
		$this->priorite = $priorite;
	}
	
	public function __construct($id, $name, $statut, $priorite){
		$this->id = $id;
		$this->name = $name;
		$this->statut = $statut;
		$this->priorite = $priorite;
	}
}
?>