<?php  

namespace Cornelissen\Shapeplace\Model;

require_once("model/Manager.php");

Class SectionManager extends Manager
{

	/*  --------------------- show section --------------------- */

	public function getSections()  
	{
		$db = $this->dbConnect();

		$sections = $db->query('SELECT * FROM section ORDER BY ID');

		return $sections;
	}

	public function getSection($idSection)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT * FROM section WHERE id = ?');
		$req->execute(array($idSection));
		$section = $req->fetch();

		return $section;
	}

	/*  --------------------- add section --------------------- */

	public function addSection($nameSection,$extractSection,$contentSection)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('INSERT INTO section(name,extract,content) VALUES(?, ?, ?)');
		$req->execute(array($nameSection,$extractSection,$contentSection));
	}

	/*  --------------------- edit section --------------------- */

	public function editSection($nameSection,$extractSection,$contentSection,$idSection)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE section SET name = ?, extract = ?, content = ? WHERE id = ?');
		$edit = $req->execute(array($nameSection,$extractSection,$contentSection,$idSection));
	}

	/*  --------------------- delete section --------------------- */

	public function deleteSection($idSection)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('DELETE FROM section WHERE id = ?');
		$req->execute(array($idSection));
	}
}