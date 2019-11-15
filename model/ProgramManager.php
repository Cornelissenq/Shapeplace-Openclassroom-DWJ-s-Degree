<?php  

namespace Cornelissen\Shapeplace\Model;

require_once("model/Manager.php");

Class ProgramManager extends Manager
{

	/*  --------------------- show program --------------------- */

	public function getAllPrograms()
	{
		$db = $this->dbConnect();

		$list = $db->query('SELECT *,program.url_slug AS programUrl,program.name AS name, program.extract AS extract, program.id AS id, section.url_slug AS sectionUrl FROM program LEFT JOIN section ON (program.id_section = section.id)');	

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

		$req = $db->prepare('SELECT *,program.name AS name, program.extract AS extract, program.id AS id, section.url_slug AS sectionUrl FROM program LEFT JOIN section ON (program.id_section = section.id) WHERE program.id = ?');
		$req->execute(array($idProgram));
		$program = $req->fetch();

		return $program;

	}

	/*  --------------------- add program --------------------- */

	public function addProgram($nameProgram,$urlSlug,$idSection,$extract,$description,$goodPoint,$badPoint,$program,$imgName)  
	{
		$db = $this->dbConnect();

		$req = $db->prepare('INSERT INTO program(name,url_slug,id_section,extract,description,good_point,bad_point,program,avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$addedprogram = $req->execute(array($nameProgram,$urlSlug,$idSection,$extract,$description,$goodPoint,$badPoint,$program,$imgName));
	}


	/*  --------------------- edit program --------------------- */

	public function editProgram($name,$urlSlug,$extract,$description,$goodPoint,$badPoint,$program,$idProgram)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE program SET name = ?,url_slug = ?,extract = ?, description = ?,good_point = ?,bad_point = ?,program = ? WHERE id = ?');
		$req->execute(array($name,$urlSlug,$extract,$description,$goodPoint,$badPoint,$program,$idProgram));
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