<?php  

namespace Cornelissen\Shapeplace\Model;

require_once("model/Manager.php");

Class CommentManager extends Manager
{

	/*  --------------------- Show comments --------------------- */

	public function getCommentsProgram($idProgram)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT *,user.pseudo AS pseudo,user.avatar AS avatar,DATE_FORMAT(comments.date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr,DATE_FORMAT(comments.date_modification, \'%d/%m/%Y à %Hh%imin\') AS date_modification_fr FROM comments LEFT JOIN user ON (comments.id_user = user.id) WHERE comments.id_program = ? AND report = "0" ORDER BY date_creation ASC ');
		$req->execute(array($idProgram));

		return $req;
	}

	public function getReportedsCommentsProgram()
	{
		$db = $this->dbConnect();

		$comments = $db->query('SELECT *,DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr,DATE_FORMAT(date_modification, \'%d/%m/%Y à %Hh%imin\') AS date_modification_fr FROM comments WHERE  report = "1" ORDER BY date_creation ASC ');
		

		return $comments;
	}

	public function getComments()
	{
		$db = $this->dbConnect();

		$comments = $db->query('SELECT *,DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr,DATE_FORMAT(date_modification, \'%d/%m/%Y à %Hh%imin\') AS date_modification_fr FROM comments WHERE  report = "0" ORDER BY date_creation DESC ');

		return $comments;
	}


	public function getCommentsUser($idComment)
	{
		$db = $this->dbConnect();

		$comments = $db->prepare('SELECT * FROM comments where id_user = ? ORDER BY date_creation DESC LIMIT 0,5');
		$comments->execute(array($idComment));

		return $comments;
	}

	/*  --------------------- Add comment --------------------- */

	public function addComment($idProgram,$idSection,$idUser,$pseudo,$comment)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('INSERT INTO comments(id_program,id_section,id_user,pseudo,comment,report) VALUES(?, ?, ?, ?, ?,"0")');
		$addedComment = $req->execute(array($idProgram,$idSection,$idUser,$pseudo,$comment));
	}
	
	/*  --------------------- Edit comment --------------------- */

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

	public function countReportedComments()
	{
		$db = $this->dbConnect();

		$req = $db->query('SELECT COUNT(*) AS nbr FROM comments WHERE report = "1"');
		$count = $req->fetch();

		return $count;
	}

	/*  --------------------- Validate comment --------------------- */

	public function validateComment($idComment)
	{
		$db = $this->dbConnect();

		$req = $db->prepare('UPDATE comments SET report = "0" WHERE id = ?');
		$req->execute(array($idComment));
	}

}