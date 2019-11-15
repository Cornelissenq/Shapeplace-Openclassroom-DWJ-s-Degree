<?php 

require_once ('model/ProgramManager.php');
require_once ('model/SectionManager.php');


Class AdminProgramController
{
	public function tableProgram()
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();


		$list = $programManager->getAllPrograms();

		require('view/backend/tableProgramView.php');
	}
	/*  --------------------- add program --------------------- */

	public function addProgram()
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$categoryList = $sectionManager->getSections();


		require('view/backend/addEditProgramView.php');

	}

	public function addedProgram($nameProgram,$idSection,$extract,$description,$goodPoint,$badPoint,$program,$img)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		if ($img['size'] <= 2100000)
		{
				                
			$infoFile = pathinfo($img['name']);
			$extensionUpload = $infoFile['extension'];
			$extensionsAllowed = array('jpg', 'jpeg', 'png');
			$name = $img['name'];
			$file = $nameProgram. '.' .$extensionUpload;
			if (in_array($extensionUpload, $extensionsAllowed))
			{
				if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name) )
				{
					$_SESSION['error'] = 'Le fichier n\'est pas une image';
					header('refresh : 0');
				}
				else
				{
					move_uploaded_file($img['tmp_name'], 'public/images/program/' . basename($file));                 
		        	$imgName = 'public/images/program/' .$file;
					$added = $programManager->addProgram($nameProgram,$idSection,$extract,$description,$goodPoint,$badPoint,$program,$imgName);

					$_SESSION['success'] = 'Le programme est ajouté';
					header('Location: ../adminProgram/');
				}
		        
			}
			else 
			{
				$_SESSION['error'] = 'L\'image doit être au format ".jpg/.jpeg/.png".';
				header('refresh : 0');
			}
		}
		else
		{
			$_SESSION['error'] = 'L\'image doit faire moins de 2Mo.';
			header('refresh : 0');
		}
	}

	/*  --------------------- edit program --------------------- */

	public function editProgram($idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$edit = 'edit';
		$categoryList = $sectionManager->getSections();
		$program = $programManager->getProgram($idProgram);

		require('view/backend/addEditProgramView.php');
	}

	public function editedProgram($name,$extract,$description,$goodPoint,$badPoint,$program,$idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		$edited = $programManager->editProgram($name,$extract,$description,$goodPoint,$badPoint,$program,$idProgram);

		$_SESSION['success'] = 'Le programme est modifié';

		header('Location: ../adminProgram/');		

	}
	public function editedProgramwAvatar($name,$extract,$description,$goodPoint,$badPoint,$program,$idProgram,$img)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		if ($img['size'] <= 2100000)
		{
				                
			$infoFile = pathinfo($img['name']);
			$extensionUpload = $infoFile['extension'];
			$extensionsAllowed = array('jpg', 'jpeg', 'png');
			$name = $img['name'];
			$file = $program. '.' .$extensionUpload;
			if (in_array($extensionUpload, $extensionsAllowed))
			{
				if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name) )
				{
					$_SESSION['error'] = 'Le fichier n\'est pas une image';
					header('refresh : 0');
				}
				else
				{
					move_uploaded_file($img['tmp_name'], 'public/images/program/' . basename($file));                 
		        	$imgName = 'public/images/program/' .$file;
		        	$edited = $programManager->editProgram($name,$extract,$description,$goodPoint,$badPoint,$program,$idProgram);
		        	$avatar = $programManager->editAvatar($imgName,$idProgram);

		        	$_SESSION['success'] = 'Le programme est modifié avec Avatar';
					header('Location: ../adminProgram/');
				}
		        
			}
			else
			{
				$_SESSION['error'] = 'L\'image doit être au format ".jpg/.jpeg/.png".';
				header('refresh : 0');
			}
		}
		else
		{
			$_SESSION['error'] = 'L\'image doit faire moins de 2Mo.';
			header('refresh : 0');
		}
	}

	/*  --------------------- delete program --------------------- */

		public function deleteProgram($idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		if ($_SESSION['role'] == 'superAdmin')
		{
			$delete = $programManager->deleteProgram($idProgram);

			$_SESSION['success'] = 'Le programme est supprimé';
		}
		else
		{
			$_SESSION['error'] = 'Vous n\'avez pas les droits nécessaires';
		}

		header('Location: ../adminProgram/');
	}
}