<?php



class User{
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
	
	private $email;
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	
	private $pwd;
	public function getPwd(){
		return $this->pwd;
	}
	public function setPwd($pwd){
		$this->pwd = $pwd;
	}
	
	
	public function __construct($id, $name, $email, $pwd){
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->pwd = $pwd;
	}

	
	public  function toString(){
		echo("user : " . $this->name ."\n");
	
	}
	
	public function subscribe(){
		SqlFunction::subscribe($this);
		echo "user create\n";
	}
	
	public function connection()
	{
		return SqlFunction::connectionUser($this);
	}
	
	public function createProject($nameProject){
		$project = new project("", $nameProject, $this->id);
		SqlFunction::createProject($project, $this);
		echo "project create\n";
	}
	
	public function  listOfProject(){
		$projectArray = SqlFunction::viewProject($this);
		foreach ($p as $projectArray)
		{
			echo $p->getName();
		}
	}
	
}
?>