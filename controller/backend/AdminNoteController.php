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

		$delete = $noteManager->deleteNote($idNote);

		$_SESSION['success'] = 'L\'avis est supprimé';
		header('Location: index.php?action=adminNotes');
	}
}