<?php

require('controller/frontend/CommentController.php');
require('controller/frontend/ProgramController.php');
require('controller/frontend/UserController.php');

require('controller/backend/AdminCommentController.php');
require('controller/backend/AdminProgramController.php');
require('controller/backend/AdminSectionController.php');

$commentController = new CommentController;
$programController = new ProgramController;
$userController = new UserController;

$adminCommentController = new AdminCommentController;
$adminProgramController = new AdminProgramController;
$adminSectionController = new AdminSectionController;

try
{
	if(isset($_GET['action']))  
	{
		$action = $_GET['action'];

		switch ($action) {
			case 'home':
				# code...
				break;

			case 'register':
				if (isset($_POST['pseudo']) && isset($_POST['pw']) && isset($_POST['pw2']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['mail']) && isset($_POST['date_birth']) && isset($_POST['city']))
				{

					$userController->register($_POST['pseudo'],$_POST['pw'],$_POST['pw2'],$_POST['name'],$_POST['surname'],$_POST['mail'],$_POST['date_birth'],$_POST['city']);
				}
				else
				{
					$userController->registerForm();
				}
				break;

			case 'login':
				if (isset($_SESSION['id_user']))
				{
					header('Location: index.php');
				}
				elseif (isset($_POST['pseudo']) && isset($_POST['pw']))
				{
					if (isset($_POST['stayOnline']))  
					{
						$userController->login($_POST['pseudo'],$_POST['pw'],$_POST['stayOnline']);
					}
					else
					{
						$userController->login($_POST['pseudo'],$_POST['pw']);
					}
				}
				else
				{
					$userController->loginForm();
				}
				break;

			case 'logout':
				$userController->logout();
				break;

			case 'section':
				$programController->getSections();
				break;

			case 'list':
				if (isset($_GET['id']) && $_GET['id'] > 0) 
				{
					$programController->showPrograms($_GET['id']);
				}
				else
				{
					/*error*/
				}
				
				break;

			case 'program':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					if (isset($_GET['section']) && $_GET['section'] > 0)
					{
						$programController->showProgram($_GET['section'],$_GET['id']);
					}
					else
					{
						/*error*/
					}
				}
				else
				{
					/*error*/
				}
				break;

			case 'addCommentP':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					if (!empty($_POST['commentProgram']))
					{
						$commentController->addCommentProgram($_GET['id'],$_POST['id_user'],$_POST['pseudo'],htmlspecialchars($_POST['commentProgram']));
					}
				}
				else
				{
				
				}
				break;
			case 'deleteCommentP':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$commentController->deleteComment($_GET['id']);
				}
				break;

			case 'editCommentP':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					if (!empty($_POST['commentEdit']))
					{
						$commentController->editCommentProgram($_POST['commentEdit'],$_GET['id']);
					}
				}
				break;

			case 'report':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$commentController->reportComment($_GET['id']);
				}
				break;


			case 'value':
				# code...
				break;

			
			default:
				
				break;

		}

	}
	else
	{
		$programController->getSections();
	}
	
}
catch(Exception $e)  {
	echo 'Erreur : ' . $e->getMessage();		
}