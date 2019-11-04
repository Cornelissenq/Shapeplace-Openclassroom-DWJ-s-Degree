<?php

require_once ('model/CommentManager.php');

Class BackendController  
{

	public function __construct()  
	{
		if (isset($_SESSION['role']))
		{
			if(($_SESSION['role'] == 'admin') OR ($_SESSION['role'] == 'superAdmin'))
			{

			}
			else
			{
				$_SESSION['error'] = 'Vous n\'avez pas les droits nécessaire pour y accéder.';

				header('Location: index.php?action=home');
			}
		}
		else  
		{
			$_SESSION['error'] = 'Vous n\'êtes pas identifié.';

			header('Location: index.php?action=login');
		}
	}

	public function panel()
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$count = $commentManager->countReportedComments();

		require('view/backend/panelView.php');
	}
}