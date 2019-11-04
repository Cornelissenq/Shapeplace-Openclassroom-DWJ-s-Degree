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

			$file = $nameProgram. '.' .$extensionUpload;
			if (in_array($extensionUpload, $extensionsAllowed))
			{
		        move_uploaded_file($img['tmp_name'], 'public/images/program/' . basename($file));                 
		        $imgName = 'public/images/program/' .$file;
		        
				header('Location: index.php?action=adminProgram');
			}
			else 
			{
				$_SESSION['error'] = 'L\'image doit être au format ".jpg/.jpeg/.png".';
				header('Location: index.php?action=addProgram');
			}
		}
		else
		{
			$_SESSION['error'] = 'L\'image doit faire moins de 2Mo.';
			header('Location: index.php?action=addProgram');
		}

		$added = $programManager->addProgram($nameProgram,$idSection,$extract,$description,$goodPoint,$badPoint,$program);

		$_SESSION['success'] = 'Le programme est ajouté';

		header('Location: index.php?action=adminProgram');
		
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

		header('Location: index.php?action=adminProgram');		

	}
	public function editedProgramwAvatar($name,$extract,$description,$goodPoint,$badPoint,$program,$idProgram,$img)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		if ($img['size'] <= 2100000)
		{
				                
			$infoFile = pathinfo($img['name']);
			$extensionUpload = $infoFile['extension'];
			$extensionsAllowed = array('jpg', 'jpeg', 'png');

			$file = $program. '.' .$extensionUpload;
			if (in_array($extensionUpload, $extensionsAllowed))
			{
		        move_uploaded_file($img['tmp_name'], 'public/images/program/' . basename($file));                 
		        $imgName = 'public/images/program/' .$file;
		        $edited = $programManager->editProgram($name,$extract,$description,$goodPoint,$badPoint,$program,$idProgram);
		        $avatar = $programManager->editAvatar($imgName,$idProgram);

		        $_SESSION['success'] = 'Le programme est modifié avec Avatar';
				header('Location: index.php?action=adminProgram');
			}
			else
			{
				$_SESSION['error'] = 'L\'image doit être au format ".jpg/.jpeg/.png".';
				header('Location: index.php?action=addProgram');
			}
		}
		else
		{
			$_SESSION['error'] = 'L\'image doit faire moins de 2Mo.';
			header('Location: index.php?action=addProgram');
		}
	}

	/*  --------------------- delete program --------------------- */

		public function deleteProgram($idProgram)
	{
		$programManager = new Cornelissen\Shapeplace\Model\ProgramManager();

		$delete = $programManager->deleteProgram($idProgram);

		$_SESSION['success'] = 'Le programme est supprimé';

		header('Location: index.php?action=adminProgram');
	}
}