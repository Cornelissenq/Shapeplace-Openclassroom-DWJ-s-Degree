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

		$place = $req->fetch();

		return $place;
	}

	public function addPlace()
	{
		$db = $this->dbConnect();

		$insert = $db->prepare('INSERT INTO section() VALUES()');
		$insert->execute(array());
	}
}