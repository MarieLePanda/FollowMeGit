<?php
class Project{
	
	private $id;
	private $name;
	private $userMaster;
	
	public function Project($id, $name, $userMaster){
		
		$this->$id = $id;
		$this->$name = $name;
		$this->$userMaster = $userMaster;
	}
	
	public function addTask($task, $id, $userMaster->getId())
	{
		insertTask($task);
	}
}