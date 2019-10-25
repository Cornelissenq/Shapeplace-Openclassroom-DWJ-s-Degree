<?php  

namespace Cornelissen\Shapeplace\Model;

require_once("model/Manager.php");

Class AreaManager extends Manager
{
	public function getPlaces()
	{
		$db = $this->dbConnect();

		$places = $db->query('SELECT * FROM area');

		return $places;
	}

	public function getPlace($idArea)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT * FROM area WHERE id = ?');
		$req->execute(array($idArea));

		$area = $req->fetch();

		return $area;
	}

	public function addPlace($name,$lat,$lng,$content,$city,$category)
	{
		$db = $this->dbConnect();

		$insert = $db->prepare('INSERT INTO area(name,lat,lng,content,city,id_category) VALUES(?, ?, ?, ?, ?, ?)');
		$add = $insert->execute(array($name,$lat,$lng,$content,$city,$category));
	}
}