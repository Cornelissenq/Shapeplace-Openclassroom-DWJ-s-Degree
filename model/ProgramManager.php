<?php  

namespace Cornelissen\Shapeplace\Model;

require_once("model/Manager.php");

Class ProgramManager extends Manager
{

	/*  --------------------- show program --------------------- */

	public function getAllPrograms()
	{
		$db = $this->dbConnect();

		$list = $db->query('SELECT * FROM program ORDER BY ID DESC');	

		return $list;
	}
	public function getPrograms($idSection)  
	{
		$db = $this->dbConnect();

		$programs = $db->prepare('SELECT * FROM program WHERE id_section = ? ORDER BY ID DESC');
		$programs->execute(array($idSection));	

		return $programs;
	}

	public function getProgram($idProgram)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT * FROM program WHERE id = ?');
		$req->execute(array($idProgram));
		$program = $req->fetch();

		return $program;

	}

	/*  --------------------- add program --------------------- */

	public function addProgram($nameProgram,$idSection,$extract,$description,$goodPoint,$badPoint,$program,$imgName)  
	{
		$db = $this->dbConnect();

		$req = $db->prepare('INSERT INTO program(name,id_section,extract,description,good_point,bad_point,program,avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
		$addedprogram = $req->execute(array($nameProgram,$idSection,$extract,$description,$goodPoint,$badPoint,$program,$imgName));
	}


	/*  --------------------- edit program --------------------- */

	public function editProgram($name,$extract,$description,$goodPoint,$badPoint,$program,$idProgram)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE program SET name = ?,extract = ?, description = ?,good_point = ?,bad_point = ?,program = ?, avatar = ? WHERE id = ?');
		$req->execute(array($name,$extract,$description,$goodPoint,$badPoint,$program,$idProgram));
	}

	public function editAvatar($avatar,$idProgram)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE program SET avatar = ? WHERE id = ?');
		$req->execute(array($avatar,$idProgram));
	}
	/*  --------------------- delete program --------------------- */

	public function deleteProgram($idProgram)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('DELETE FROM program WHERE id = ?');
		$req->execute(array($idProgram));
	}
}