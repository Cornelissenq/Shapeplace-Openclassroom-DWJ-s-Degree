<?php

require('controller/frontend/CommentController.php');
require('controller/frontend/ProgramController.php');
require('controller/frontend/UserController.php');
require('controller/frontend/AreaController.php');
require('controller/frontend/NoteController.php');
require('controller/frontend/HomeController.php');

require('controller/backend/BackendController.php');
require('controller/backend/AdminCommentController.php');
require('controller/backend/AdminProgramController.php');
require('controller/backend/AdminSectionController.php');
require('controller/backend/AdminUserController.php');
require('controller/backend/AdminAreaController.php');
require('controller/backend/AdminNoteController.php');

$commentController = new CommentController;
$programController = new ProgramController;
$userController = new UserController;
$areaController = new AreaController;
$noteController = new NoteController;
$homeController = new HomeController;

$adminCommentController = new AdminCommentController;
$adminProgramController = new AdminProgramController;
$adminSectionController = new AdminSectionController;
$adminUserController = new AdminUserController;
$adminAreaController = new AdminAreaController;
$adminNoteController = new AdminNoteController;

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
				else
				{
					$homeController->error();
				}
				break;

			case 'editProfil':
				if (isset($_SESSION['id_user']))
				{
					$userController->editProfil($_SESSION['id_user']);
				}
				else
				{
					$homeController->error();
				}
				break;

			case 'editAvatar':
				if (isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0)
				{
					$userController->editAvatar($_FILES['avatar'],$_SESSION['id_user']);
				}
				else
				{
					$homeController->error();
				}

				break;

			case 'editPw':
				if (isset($_POST['oldPw']) && isset($_POST['newPw']) && isset($_POST['newPw2']))
				{
					$testPw = $userController->editPw($_SESSION['pseudo'],$_POST['oldPw'],$_POST['newPw'],$_POST['newPw2']);
				}
				else
				{
					$homeController->error();
				}

				break;

			case 'editMail':
				if(isset($_POST['mail']) && isset($_POST['mail2']))
				{
					$userController->editMail($_POST['mail'],$_POST['mail2'],$_SESSION['id_user']);
				}
				else
				{
					$homeController->error();
				}
				break;

			case 'editInsta':
				if (isset($_POST['insta']))
				{
					$editInsta = $userController->editInsta($_POST['insta'],$_SESSION['id_user']);
				}
				else
				{
					$homeController->error();
				}
				break;

			case 'editCity':
				if (isset($_POST['city']))
				{
					$editInsta = $userController->editCity($_POST['city'],$_SESSION['id_user']);
				}
				else
				{
					$homeController->error();
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
					$homeController->error();
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
						$homeController->error();
					}
				}
				else
				{
					$homeController->error();
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
					$homeController->error();
				}
				break;
			case 'deleteCommentP':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$commentController->deleteComment($_GET['id']);
				}
				else
				{
					$homeController->error();
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
				else
				{
					$homeController->error();
				}
				break;

			case 'report':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$commentController->reportComment($_GET['id']);
				}
				else
				{
					$homeController->error();
				}
				break;


			case 'value':
				# code...
				break;

	/*  --------------------- Map --------------------- */

			case 'map':
				if(isset($_POST['search']))
				{
					$areaController->setMap($_POST['search']);
				}
				elseif (isset($_GET['search']))
				{
					$areaController->setMap($_GET['search']);
				}
				else
				{
					$homeController->error();
				}
				break;
			
			case 'addArea':
				if (isset($_POST['name']) && isset($_POST['content']) && isset($_POST['city']) && isset($_POST['category']))
				{
					$areaController->addArea(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['lat']), htmlspecialchars($_POST['lng']), htmlspecialchars($_POST['content']), htmlspecialchars($_POST['city']), $_POST['category']);
				}
				else
				{
					$areaController->formAddArea($_POST['lat'],$_POST['lng'],$_POST['search']);
				}
				break;

			case 'area':
				if(isset($_GET['id']) && isset($_GET['search']))
				{
					$areaController->showArea($_GET['id'],$_GET['search']);
				}
				else
				{
					$homeController->error();
				}
				break;

			case 'addNote':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$noteController->addNote($_GET['id'],$_SESSION['id_user'],$_SESSION['pseudo'],$_POST['noteArea'],htmlspecialchars($_POST['content']));
				}
				break;

			case 'deleteNote':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$noteController->deleteNote($_GET['id']);
				}
				else
				{
					$homeController->error();
				}
				break;
	/*  ------------------------------------------ Backend ------------------------------------------ */

			case 'admin':
				$backendController = new BackendController;

				$backendController->panel();
				break;

	/*  --------------------- AdminUser --------------------- */

			case 'adminUser':
				$backendController = new BackendController;

				$adminUserController->tableUser();
				break;

			case 'givePower':
				$backendController = new BackendController;

				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$adminUserController->givePower($_GET['id']);
				}
				else
				{
					$homeController->error();
				}
				break;

			case 'remainPower':
				$backendController = new BackendController;

				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$adminUserController->remainPower($_GET['id']);
				}
				else
				{
					$homeController->error();
				}
				break;

			case 'deleteUser':
				$backendController = new BackendController;

				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$adminUserController->deleteUser($_GET['id']);
				}
				else
				{
					$homeController->error();
				}
				break;
	/*  --------------------- AdminSection --------------------- */
			case 'adminSection':
				$backendController = new BackendController;

				$adminSectionController->tableSection();
				break;

			case 'addSection':
				$backendController = new BackendController;
				if (isset($_POST['name']) && isset($_POST['extract']) && isset($_POST['content']))
				{
					$adminSectionController->addedSection($_POST['name'],$_POST['extract'],$_POST['content']);
				}
				else
				{
					$adminSectionController->addSection();
				}
				break;

			case 'editSection':
				$backendController = new BackendController;
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					if (isset($_POST['name']) && isset($_POST['extract']) && isset($_POST['content']))
					{
						$adminSectionController->editedSection($_POST['name'],$_POST['extract'],$_POST['content'],$_GET['id']);
					}
					else
					{
						$adminSectionController->editSection($_GET['id']);
					}
				}
				else
				{
					$homeController->error();
				}	
				break;

			case 'deleteSection':
				$backendController = new BackendController;
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$adminSectionController->deleteSection($_GET['id']);
				}
				else
				{
					$homeController->error();
				}
				break;

	/*  --------------------- AdminProgram --------------------- */
			case 'adminProgram':
				$backendController = new BackendController;
				$adminProgramController->tableProgram();
				break;

			case 'addProgram':
				$backendController = new BackendController;
				if (isset($_POST['name']) && isset($_POST['category']) && isset($_POST['extract']) && isset($_POST['description'])&& isset($_POST['program']))
				{
					$adminProgramController->addedProgram($_POST['name'],$_POST['category'],$_POST['extract'],$_POST['description'],$_POST['good_point'],$_POST['bad_point'],$_POST['program']);
				}
				else
				{
					$adminProgramController->addProgram();
				}
				break;

			case 'editProgram':
				$backendController = new BackendController;
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					if (isset($_POST['name']) && isset($_POST['extract']) && isset($_POST['description'])&& isset($_POST['program']))
					{
						$adminProgramController->editedProgram($_POST['name'],$_POST['extract'],$_POST['description'],$_POST['good_point'],$_POST['bad_point'],$_POST['program'],$_GET['id']);
					}
					else
					{
						$adminProgramController->editProgram($_GET['id']);
					}
				}
				else
				{
					$homeController->error();
				}
					
				break;

			case 'deleteProgram':
				$backendController = new BackendController;
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$adminProgramController->deleteProgram($_GET['id']);
				}
				else
				{
					$homeController->error();
				}
				break;
	/*  --------------------- AdminComment --------------------- */
			case 'adminComment':
				$backendController = new BackendController;
				$adminCommentController->tableComment();
				break;

			case 'adminReportComment':
				$backendController = new BackendController;
				$adminCommentController->tableReportComment();
				break;

			case 'validateComment':
				$backendController = new BackendController;
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$adminCommentController->validateComment($_GET['id']);
				}
				else
				{
					$homeController->error();
				}
				break;

			case 'deleteComment':
				$backendController = new BackendController;
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$adminCommentController->deleteComment($_GET['id']);
				}
				else
				{
					$homeController->error();
				}
				break;
/*  --------------------- AdminArea --------------------- */
			case 'adminSpot':
				$backendController = new BackendController;
				$adminAreaController->tableArea();

				break;

			case 'editSpot':
				$backendController = new BackendController;
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					if(isset($_POST['name']) && isset($_POST['content']) && isset($_POST['city']) && isset($_POST['id_category']))
					{
						$adminAreaController->editedArea($_POST['name'],$_POST['content'],$_POST['city'],$_POST['id_category'],$_GET['id']);
					}
					else
					{
						$adminAreaController->editArea($_GET['id']);
					}
				}
				else
				{
					$homeController->error();
				}

				break;

			case 'deleteSpot':
				$backendController = new BackendController;
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$adminAreaController->deleteArea($_GET['id']);
				}
				else
				{
					$homeController->error();
				}

				break;

/*  --------------------- AdminNote --------------------- */
			case 'adminNotes':
				$backendController = new BackendController;
				$adminNoteController->tableNotes();

				break;
			case 'deleteNotes':
				$backendController = new BackendController;
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					$adminNoteController->deleteNotes($_GET['id']);
				}
				else
				{
					$homeController->error();
				}			

				break;

		}

	}
	else
	{
		$homeController->home();
	}
	
}
catch(Exception $e)  {
	echo 'Erreur : ' . $e->getMessage();		
}