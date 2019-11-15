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

	public function addSection($nameSection,$urlSlug,$extractSection,$contentSection,$imgName)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('INSERT INTO section(name,url_slug,extract,content,img) VALUES(?, ?, ?, ?, ?)');
		$req->execute(array($nameSection,$urlSlug,$extractSection,$contentSection,$imgName));
	}

	/*  --------------------- edit section --------------------- */

	public function editSection($nameSection,$urlSlug,$extractSection,$contentSection,$idSection)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE section SET name = ?, url_slug = ?, extract = ?, content = ? WHERE id = ?');
		$edit = $req->execute(array($nameSection,$urlSlug,$extractSection,$contentSection,$idSection));
	}

	public function editAvatar($imgName,$idSection)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE section SET img = ? WHERE id = ?');
		$req->execute(array($imgName,$idSection));
	}

	/*  --------------------- delete section --------------------- */

	public function deleteSection($idSection)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('DELETE FROM section WHERE id = ?');
		$req->execute(array($idSection));
	}
}