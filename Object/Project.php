<?php

class Project{
	
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
	
	private $idUserMaster;
	public function getIdUserMaster(){
		return $this->idUserMaster;
	}
	public function setIdUserMaster($iduserMaster){
		$this->idUserMaster = $iduserMaster;
	}
	
	private $listTask;
	public function getListTask(){
		return SqlFunction::listTask($project);
	}
	
	private $listStatut;
	public function getListStatut(){
		return SqlFunction::statut($this);
	}
	
	public function __construct($id, $name, $idUserMaster){
		$this->id = $id;
		$this->name = $name;
		$this->idUserMaster = $idUserMaster;
	}
}