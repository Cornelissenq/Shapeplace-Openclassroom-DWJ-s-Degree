<?php 

require_once ('model/NoteManager.php');

Class AdminNoteController
{
	public function tableNotes()
	{
		$noteManager = new Cornelissen\ShapePlace\Model\NoteManager();

		$list = $noteManager->getAllNotes();

		require('view/backend/tableNotesView.php');
	}

	public function deleteNotes($idNote)
	{
		$noteManager = new Cornelissen\ShapePlace\Model\NoteManager();

		if ($_SESSION['role'] == 'superAdmin')
		{
			$delete = $noteManager->deleteNote($idNote);

			$_SESSION['success'] = 'L\'avis est supprimé';
		}
		else
		{
			$_SESSION['error'] = 'Vous n\'avez pas les droits nécessaires';
		}
		header('Location: ../adminNotes/');
	}
}