<?php 

require_once ('model/SectionManager.php');

Class AdminSectionController
{
	public function tableSection()
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();


		$list = $sectionManager->getSections();

		require('view/backend/tableSectionView.php');
	}

	/*  --------------------- add section --------------------- */

	public function addSection()
	{
		require('view/backend/addEditSectionView.php');
	}

	public function addedSection($nameSection,$extractSection,$contentSection,$img)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		if ($img['size'] <= 2100000)
		{
				                
			$infoFile = pathinfo($img['name']);
			$extensionUpload = $infoFile['extension'];
			$extensionsAllowed = array('jpg', 'jpeg', 'png');
			$name = $img['name'];
			$file = $nameSection. '.' .$extensionUpload;
			if (in_array($extensionUpload, $extensionsAllowed))
			{
				if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name) )
				{
					$_SESSION['error'] = 'Le fichier n\'est pas une image';
					header('refresh : 0');
				}
				else
				{
					
					$urlSlug = preg_replace('~[^\pL\d]+~u', '-', $nameSection);
					$urlSlug = iconv('utf-8', 'us-ascii//TRANSLIT', $urlSlug);
					$urlSlug = preg_replace('~[^-\w]+~', '', $urlSlug);
					$urlSlug = trim($urlSlug, '-');
					$urlSlug = preg_replace('~-+~', '-', $urlSlug);
					$urlSlug = strtolower($urlSlug);

					move_uploaded_file($img['tmp_name'], 'public/images/section/' . basename($file));                 
		        	$imgName = 'public/images/section/' .$file;
		        	$add = $sectionManager->addSection($nameSection,$urlSlug,$extractSection,$contentSection,$imgName);

		        	$_SESSION['success'] = 'La section est modifiée.';
					header('Location: ../adminSection/');
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

	/*  --------------------- edit section --------------------- */

	public function editSection($idSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$edit = 'edit';		
		$section = $sectionManager->getSection($idSection);

		require('view/backend/addEditSectionView.php');
	}

	public function editedSection($nameSection,$extractSection,$contentSection,$idSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$urlSlug = preg_replace('~[^\pL\d]+~u', '-', $nameSection);
		$urlSlug = iconv('utf-8', 'us-ascii//TRANSLIT', $urlSlug);
		$urlSlug = preg_replace('~[^-\w]+~', '', $urlSlug);
		$urlSlug = trim($urlSlug, '-');
		$urlSlug = preg_replace('~-+~', '-', $urlSlug);
		$urlSlug = strtolower($urlSlug);

		$edited = $sectionManager->editSection($nameSection,$urlSlug,$extractSection,$contentSection,$idSection);

		$_SESSION['success'] = 'La section est modifiée';

		header('Location: ../adminSection/');
	}

	public function editedSectionwAvatar($nameSection,$extractSection,$contentSection,$idSection,$img)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();


		if ($img['size'] <= 2100000)
		{
				                
			$infoFile = pathinfo($img['name']);
			$extensionUpload = $infoFile['extension'];
			$extensionsAllowed = array('jpg', 'jpeg', 'png');
			$name = $img['name'];
			$file = $nameSection. '.' .$extensionUpload;
			if (in_array($extensionUpload, $extensionsAllowed))
			{
				if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name) )
				{
					$_SESSION['error'] = 'Le fichier n\'est pas une image';
					header('refresh : 0');
				}
				else
				{
					$urlSlug = preg_replace('~[^\pL\d]+~u', '-', $nameSection);
					$urlSlug = iconv('utf-8', 'us-ascii//TRANSLIT', $urlSlug);
					$urlSlug = preg_replace('~[^-\w]+~', '', $urlSlug);
					$urlSlug = trim($urlSlug, '-');
					$urlSlug = preg_replace('~-+~', '-', $urlSlug);
					$urlSlug = strtolower($urlSlug);

					move_uploaded_file($img['tmp_name'], 'public/images/section/' . basename($file));                 
		        	$imgName = 'public/images/section/' .$file;
		        	$edited = $sectionManager->editSection($nameSection,$urlSlug,$extractSection,$contentSection,$idSection);
		        	$avatar = $sectionManager->editAvatar($imgName,$idSection);

		        	$_SESSION['success'] = 'La section est modifiée.';
					header('Location: ../adminSection/');
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

	/*  --------------------- delete section --------------------- */
	
	public function deleteSection($idSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$delete = $sectionManager->deleteSection($idSection);

		$_SESSION['success'] = 'La section est supprimée';

		header('Location: ../adminSection/');
	}
}