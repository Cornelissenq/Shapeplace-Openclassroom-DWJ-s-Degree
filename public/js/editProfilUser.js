// Affiche le formulaire de changement de mdp
$('#showEditPw').click(function()
{
	$('#editPassword').css('display','block');
	$('#showEditPw').css('display','none');
});

//Affiche le formulaire pour le lien instagram
$('#showEditInsta').click(function()
{
	$('#showEditInsta').css('display','none');
	$('#linkInsta').css('display','none');
	$('#editInsta').css('display','block');
});

$('#showAddInsta').click(function()
{
	$('#showAddInsta').css('display','none');
	$('#editInsta').css('display','block');
});

//Affiche le formulaire pour modif l'adresse mail
$('#showEditMail').click(function()
{
	$('#showEditMail').css('display','none');
	$('#editMail').css('display','block');
});

//Affiche le formulaire pour modif la ville
$('#showEditCity').click(function()
{
	$('#showEditCity').css('display','none');
	$('#editCity').css('display','block');
});