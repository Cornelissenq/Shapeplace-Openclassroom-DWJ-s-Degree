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
		require('view/backend/addSectionView.php');
	}

	public function addedSection($nameSection,$extractSection,$contentSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$add = $sectionManager->addSection($nameSection,$extractSection,$contentSection);

		$_SESSION['success'] = 'La section est ajoutée.';

		header('Location: index.php?action=adminSection');
	}

	/*  --------------------- edit section --------------------- */

	public function editSection($idSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$section = $sectionManager->getSection($idSection);

		require('view/backend/editSectionView.php');
	}

	public function editedSection($nameSection,$extractSection,$contentSection,$idSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$edited = $sectionManager->editSection($nameSection,$extractSection,$contentSection,$idSection);

		$_SESSION['success'] = 'La section est modifiée';

		header('Location: index.php?action=adminSection');
	}

	/*  --------------------- delete section --------------------- */
	
	public function deleteSection($idSection)
	{
		$sectionManager = new Cornelissen\Shapeplace\Model\SectionManager();

		$delete = $sectionManager->deleteSection($idSection);

		$_SESSION['success'] = 'La section est supprimée';

		header('Location: index.php?action=adminSection');
	}
}