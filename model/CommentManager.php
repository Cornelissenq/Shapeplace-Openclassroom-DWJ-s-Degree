<?php  

namespace Cornelissen\Shapeplace\Model;

require_once("model/Manager.php");

Class CommentManager extends Manager
{

	/*  --------------------- Show comments --------------------- */

	public function getCommentsProgram($idProgram)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT *,DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM comments WHERE id_program = ? AND report = "0" ORDER BY date_creation ASC ');
		$req->execute(array($idProgram));

		return $req;
	}

	public function getReportedsCommentsProgram($idArea)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT *,DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM comments WHERE id_program = ? AND report = "1" ORDER BY date_creation ASC ');
		$req->execute(array($idProgram));
		$comments = $req->fetch();

		return $comments;
	}

	public function getCommentsArea($idArea)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT *,DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM comments WHERE id_area = ? ORDER BY date_creation ASC ');
		$req->execute(array($idArea));
		$comments = $req->fetch();

		return $comments;
	}

	public function getReportedsCommentsArea($idArea)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT *,DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM comments WHERE id_area = ? AND report = "1" ORDER BY date_creation ASC ');
		$req->execute(array($idArea));
		$comments = $req->fetch();

		return $comments;
	}

	public function getComment($idComment)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT * FROM comments where id = ?');
		$req->execute(array($idComment));
		$comment = $req->fetch();

		return $comment;
	}

	/*  --------------------- Add comment --------------------- */

	public function addComment($idProgram,$idUser,$pseudo,$comment)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('INSERT INTO comments(id_program,id_user,pseudo,comment,report) VALUES(?, ?, ?, ?,"0")');
		$addedComment = $req->execute(array($idProgram,$idUser,$pseudo,$comment));
	}
	
	/*  --------------------- Edit comment --------------------- */

	public function editComment($comment,$note,$idComment)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE comments SET comment = ?, note = ?, date_modification = ? WHERE id = ?');
		$req->execute(array($comment,$note,NOW(),$idComment));
	}

		public function editCommentProgram($comment,$idComment)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE comments SET comment = ?, date_modification = NOW() WHERE id = ?');
		$req->execute(array($comment,$idComment));
	}


	/*  --------------------- Delete comment --------------------- */

	public function deleteComment($idComment)  
	{
		$db = $this->dbConnect();

		$req = $db->prepare('DELETE FROM comments WHERE id = ?');
		$req->execute(array($idComment));
	}

	/*  --------------------- Report comment --------------------- */	

	public function reportComment($idComment)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE comments SET report = "1" WHERE id = ?');
		$req->execute(array($idComment));
	}

	/*  --------------------- Validate comment --------------------- */

	public function validateComment($idComment)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE comments SET report = "0" WHERE id = ?');
		$req->execute(array($idComment));
	}
}