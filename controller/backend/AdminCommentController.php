<?php 

require_once ('model/CommentManager.php');

Class AdminCommentController
{

	public function tableComment()
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$list = $commentManager->getComments();

		require('view/backend/tableCommentView.php');
	}

	public function tableReportComment()
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$list = $commentManager->getReportedsCommentsProgram();

		require('view/backend/tableReportedCommentView.php');
	}

	public function validateComment($idComment)
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$allow = $commentManager->validateComment($idComment);

		$_SESSION['success'] = 'Le commentaire est validé.';

		header('Location: index.php?action=adminReportComment');
	}

	public function deleteComment($idComment)
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$delete = $commentManager->deleteComment($idComment);

		$_SESSION['success'] = 'Le commentaire est supprimé.';

		header('Location: index.php?action=adminReportComment');
	}

}