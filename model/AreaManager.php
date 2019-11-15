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

		$req = $db->prepare('SELECT *,area.id AS id ,tools.type AS type FROM area LEFT JOIN tools ON (area.id_category = tools.id) WHERE area.id = ? ');
		$req->execute(array($idArea));

		$area = $req->fetch();

		return $area;
	}

	public function addPlace($name,$urlSlug,$lattitude,$longitude,$content,$city,$category)
	{
		$db = $this->dbConnect();

		$insert = $db->prepare('INSERT INTO area(name,url_slug,lat,lng,content,city,id_category) VALUES(?, ?, ?, ?, ?, ?, ?)');
		$add = $insert->execute(array($name,$urlSlug,$lattitude,$longitude,$content,$city,$category));
	}

	public function editArea($name,$urlSlug,$description,$city,$idCategory,$idArea)
	{
		$db = $this->dbConnect();

		$edit = $db->prepare('UPDATE area SET name = ?, url_slug = ?, content = ?, city = ?, id_category = ? WHERE id = ?');
		$edit->execute(array($name,$urlSlug,$description,$city,$idCategory,$idArea));
	}

	public function deleteArea($idArea)
	{
		$db = $this->dbConnect();

		$delete = $db->prepare('DELETE FROM area WHERE id = ?');
		$delete->execute(array($idArea));
	}

	public function listCategory()
	{
		$db = $this->dbConnect();

		$listCategory = $db->query('SELECT * FROM tools');

		return $listCategory;
	}
}