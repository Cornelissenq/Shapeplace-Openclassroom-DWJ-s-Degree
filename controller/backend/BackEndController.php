<?php

require_once ('model/CommentManager.php');
require_once ('model/UserManager.php');

Class BackendController  
{

	public function __construct()  
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		if (isset($_SESSION['role']))
		{
			if(($_SESSION['role'] == 'admin') OR ($_SESSION['role'] == 'superAdmin'))
			{
				$role = $userManager->checkRoles($_SESSION['pseudo'],$_SESSION['role'],$_SESSION['id_user']);

				if($role)
				{

				}
				else
				{
					$_SESSION['error'] = 'Vous n\'avez pas les droits nécessaire pour y accéder.';

					header('Location: ../accueil/');
				}
			}
			else
			{
				$_SESSION['error'] = 'Vous n\'avez pas les droits nécessaire pour y accéder.';

				header('Location: ../accueil/');
			}
		}
		else  
		{
			$_SESSION['error'] = 'Vous n\'êtes pas identifié.';

			header('Location: ../accueil/');
		}
	}

	public function panel()
	{
		$commentManager = new Cornelissen\Shapeplace\Model\CommentManager();

		$count = $commentManager->countReportedComments();

		require('view/backend/panelView.php');
	}
}