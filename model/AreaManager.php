<?php  

namespace Cornelissen\Shapeplace\Model;

require_once("model/Manager.php");

Class AreaManager extends Manager
{
	public function getPlaces()
	{
		$db = $this->dbConnect();

		$places = $db->query('SELECT * FROM area ORDER BY id DESC');

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

	public function editArea($name,$description,$city,$idCategory,$idArea)
	{
		$db = $this->dbConnect();

		$edit = $db->prepare('UPDATE area SET name = ?, content = ?, city = ?, id_category = ? WHERE id = ?');
		$edit->execute(array($name,$description,$city,$idCategory,$idArea));
	}

	public function deleteArea($idArea)
	{
		$db = $this->dbConnect();

		$delete = $db->prepare('DELETE FROM area WHERE id = ?');
		$delete->execute(array($idArea));
	}

	public function getCategory($idArea)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT *,t.type AS nom_category FROM area a LEFT JOIN tools t ON a.id_category = t.id_category AND id_area = ?');
		$req->execute(array($idArea));

		$category = $req->fetch();

		return $category;
	}

}