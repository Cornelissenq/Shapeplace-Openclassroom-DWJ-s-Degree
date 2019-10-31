<?php 

require_once ('model/CommentManager.php');

Class CommentController
{

	/*  --------------------- Add comment --------------------- */


	public function addCommentProgram($idProgram,$idSection,$idUser,$pseudo,$comment)
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$add = $commentManager->addComment($idProgram,$idSection,$idUser,$pseudo,$comment);

		
		$_SESSION['success'] = 'Le commentaire est bien ajouté';

		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: index.php?action=home');
		}
	}

	/*  --------------------- Edit comment --------------------- */

	public function editCommentProgram($comment,$idComment)
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$edited = $commentManager->editCommentProgram($comment,$idComment);

		
		$_SESSION['success'] = 'Le commentaire est modifié.';

		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: index.php?action=home');
		}
	}

	/*  --------------------- Report comment --------------------- */

	public function reportComment($idComment)
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$report = $commentManager->reportComment($idComment);

		
		$_SESSION['success'] = 'Le commentaire est signalé.';

		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: index.php?action=home');
		}
		
	}

	/*  --------------------- Delete comment --------------------- */

	public function deleteComment($idComment)
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$delete = $commentManager->deleteComment($idComment);

		
		$_SESSION['success'] = 'Le commentaire est bien supprimé';

		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: index.php?action=home');
		}
	}


}