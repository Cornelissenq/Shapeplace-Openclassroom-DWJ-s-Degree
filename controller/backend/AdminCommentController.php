<?php 

require_once ('model/CommentManager.php');

Class AdminCommentController
{

	public function validateComment($idComment)
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$allow = $commentManager->validateComment($idComment);

		$_SESSION['success'] = 'Le commentaire est validé.';

		header('Location:..');
	}

	public function deleteComment($idComment)
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$delete = $commentManager->validateComment($idComment);

		$_SESSION['success'] = 'Le commentaire est supprimé.';
	}

}