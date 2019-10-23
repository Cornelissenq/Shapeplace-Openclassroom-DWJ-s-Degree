<?php

require('controller/frontend/CommentController.php');
require('controller/frontend/ProgramController.php');
require('controller/frontend/UserController.php');
require('controller/frontend/AreaController.php');
require('controller/frontend/HomeController.php');

require('controller/backend/AdminCommentController.php');
require('controller/backend/AdminProgramController.php');
require('controller/backend/AdminSectionController.php');

$commentController = new CommentController;
$programController = new ProgramController;
$userController = new UserController;
$areaController = new AreaController;
$homeController = new homeController;

$adminCommentController = new AdminCommentController;
$adminProgramController = new AdminProgramController;
$adminSectionController = new AdminSectionController;

session_start();

try
{
	if(isset($_GET['action']))  
	{
		$action = $_GET['action'];

		switch ($action) {
			case 'home':
				$homeController->home();
				break;
	/*  --------------------- User Action's --------------------- */
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

			case 'userProfil':
				if(isset($_GET['id']))
				{
					$userController->showProfil($_GET['id']);
				}
				break;

			case 'editProfil':
				if (isset($_SESSION['id_user']))
				{
					$userController->editProfil($_SESSION['id_user']);
				}
				break;

			case 'editAvatar':
				if (isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0)
				{
				    if ($_FILES['avatar']['size'] <= 2100000)
				    {
				                
				        $infoFile = pathinfo($_FILES['avatar']['name']);
		                $extensionUpload = $infoFile['extension'];
		                $extensionsAllowed = array('jpg', 'jpeg', 'png');

		                $file = $_SESSION['id_user']. '.' .$extensionUpload;
		                if (in_array($extensionUpload, $extensionsAllowed))
		                {
	                        move_uploaded_file($_FILES['avatar']['tmp_name'], 'public/images/user/' . basename($file));
	                        
	                        $path = 'public/images/user/' .$file;

	                        $userController->editAvatar($path,$_SESSION['id_user']);
		                }
			        }
				}

				break;

			case 'editPw':
				if (isset($_POST['oldPw']) && isset($_POST['newPw']) && isset($_POST['newPw2']))
				{
					$testPw = $userController->editPw($_SESSION['pseudo'],$_POST['oldPw'],$_POST['newPw'],$_POST['newPw2']);
				}

				break;

			case 'editMail':
				if(isset($_POST['mail']) && isset($_POST['mail2']))
				{
					$userController->editMail($_POST['mail'],$_POST['mail2'],$_SESSION['id_user']);
				}

				break;

			case 'editInsta':
				if (isset($_POST['insta']))
				{
					$editInsta = $userController->editInsta($_POST['insta'],$_SESSION['id_user']);
				}
				break;

			case 'editCity':
				if (isset($_POST['city']))
				{
					$editInsta = $userController->editCity($_POST['city'],$_SESSION['id_user']);
				}
				break;

	/*  --------------------- Program Action's --------------------- */

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

	/*  --------------------- Comment Action's --------------------- */

			case 'addCommentP':
				if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idsection']) && $_GET['idsection'] > 0)
				{
					if (!empty($_POST['commentProgram']))
					{
						$commentController->addCommentProgram($_GET['id'],$_GET['idsection'],$_SESSION['id_user'],$_SESSION['pseudo'],htmlspecialchars($_POST['commentProgram']));
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

	/*  --------------------- Map --------------------- */
			case 'map':
				if(isset($_POST['address']))
				{
					$areaController->setMap($_POST['address']);
				}
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