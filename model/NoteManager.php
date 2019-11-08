<?php

namespace Cornelissen\Shapeplace\Model;

require_once('model/Manager.php');

Class NoteManager extends Manager
{
	public function getAllNotes()
	{
		$db = $this->dbConnect();

		$list = $db->query('SELECT *,area_note.id AS id,user.id AS id_user,user.pseudo AS pseudo,user.avatar AS avatar,DATE_FORMAT(area_note.date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM area_note LEFT JOIN user ON (area_note.id_user = user.id) ORDER BY date_creation DESC ');

		return $list;
	}

	public function getNotes($idArea)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT *,area_note.id AS id,user.id AS id_user,user.pseudo AS pseudo,user.avatar AS avatar,DATE_FORMAT(area_note.date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM area_note LEFT JOIN user ON (area_note.id_user = user.id) WHERE area_note.id_area = ? ORDER BY date_creation DESC ');
		$req->execute(array($idArea));

		return $req;
	}

	public function addNote($idArea,$idUser,$note,$content)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('INSERT INTO area_note(id_area,id_user,note,content) VALUES(?, ?, ?, ?)');
		$add = $req->execute(array($idArea,$idUser,$note,$content));
	}

	public function deleteNote($idNote)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('DELETE FROM area_note WHERE id = ?');
		$req->execute(array($idNote));
	}

	public function averageNote($idArea)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT AVG(note) AS avg FROM area_note WHERE id_area = ?');
		$req->execute(array($idArea));
		
		$avgNote = $req->fetch();

		return $avgNote;
	}

}