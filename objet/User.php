<?php

class  User
{
	private $id;
	private $pseudo;
	private $email;
	private $password;
	
	public function User($id, $pseudo, $email, $password)
	{
		$this->$id = $id;
		$this->$pseudo = $pseudo;
		$this->$email = $email;
		$this->$password = $password;
	}
	
	public function newProject($name)
	{
		nouveauProjet($name, $id);
	}
	
	public function editProject($project){
		updateProject($project);
	}
	
	public function deleteProject($project)
	{
		dropProject($project, $id);
	}
	
	
	public function getId(){
		return $this->$id;
	}
	
	public function toString(){
		echo $id . " " . $pseudo . " " . $email . " " . $password;
	}
}

?>