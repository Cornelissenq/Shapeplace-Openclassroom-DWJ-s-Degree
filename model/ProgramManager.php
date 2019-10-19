<?php  

namespace Cornelissen\Shapeplace\Model;

require_once("model/Manager.php");

Class ProgramManager extends Manager
{

	/*  --------------------- show program --------------------- */

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

	public function addProgram($idSection,$nameProgram,$extractProgram,$descriptionProgram,$goodPoint,$badPoint,$programProgram)  
	{
		$db = $this->dbConnect();

		$req = $db->prepare('INSERT INTO program(id_section,name,extract,description,good_point,bad_point,program,date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
		$addedprogram = $req->execute(array($idSection,$nameProgram,$extractProgram,$descriptionProgram,$goodPoint,$badPoint,$programProgram, NOW()));
	}

	/*  --------------------- edit program --------------------- */

	public function editProgram($nameProgram,$extractProgram,$descriptionProgram,$goodPoint,$badPoint,$programProgram,$idSection)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE program SET name = ?,extract = ?, description = ?,good_point = ?,bad_point = ?,program = ? WHERE id = ?');
		$req->execute(array($nameProgram,$extractProgram,$descriptionProgram,$goodPoint,$badPoint,$programProgram,$idSection));
	}

	/*  --------------------- delete program --------------------- */

	public function deleteProgram($idProgram)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('DELETE FROM program WHERE id = ?');
		$req->execute(array($idProgram));
	}
}