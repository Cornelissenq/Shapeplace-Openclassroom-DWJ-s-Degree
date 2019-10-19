<?php 

require_once ('model/UserManager.php');

Class UserController
{
	public function loginForm()
	{
		if (isset($_SESSION['id_user']))
		{
			$_SESSION['error'] = 'Vous êtes déja identifié.';

			header('Location: index.php?action=home ');
		}
		else
		{
			require('view/frontend/formLoginView.php');
		}
	}
	public function login($pseudo,$pw)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		$result = $userManager->login($pseudo,$pw);

	
		if ($result)
		{
			session_start();

			if ($_POST['stayOnline'])
			{
				setcookie("id_user", $result['id'], time() + (86400 * 365));
				setcookie("pseudo", $result['pseudo'], time() + (86400 * 365));
				setcookie("role", $result['role'], time() + (86400 * 365));
			}
			
			
			$_SESSION['success'] = 'Vous êtes bien identifié.';

			$_SESSION['id_user'] = $result['id'];
			$_SESSION['pseudo'] = $result['pseudo'];
			$_SESSION['role'] = $result['role'];

			header('Location: index.php');
		}
		else
		{
			session_start();
			$_SESSION['error'] = 'Mauvais identifiants, merci de réitérer votre demande.';

			header('Location: index.php?action=login');
		}
	}

	public function logout()
	{
		if (isset($_COOKIE['id_user']))
		{
			setcookie("id_user", "",time()-3600);
			setcookie("pseudo", "",time()-3600);
			setcookie("role", "",time()-3600);	
		}
		session_start();
		$_SESSION = array();
		session_destroy();
		
		session_start();
		$_SESSION['success'] = 'Vous êtes bien déconnecté.';
		
		header('Refresh: 0.2 ' . $_SERVER["HTTP_REFERER"]);
	}

	public function registerForm()
	{
		if (isset($_SESSION['id_user']))
		{
			session_start();
			$_SESSION['error'] = 'Vous êtes déja identifié.';

			header('Location: index.php');
		}
		else
		{
			require('view/frontend/formRegisterView.php');
		}
	}
	public function register($pseudo,$pw,$pw2,$name,$surname,$email,$date_birth,$city)
	{
		$userManager = new Cornelissen\Shapeplace\Model\UserManager();

		$pseudoTest = $userManager->checkPseudo($pseudo);
		$emailTest = $userManager->checkEmail($email);

		if (!$pseudoTest)
		{
			if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
			{
				if(!$emailTest)
				{
					if ($pw === $pw2)
					{
						$register = $userManager->register($pseudo,$pw,$name,$surname,$email,$date_birth,$city);
						$login = $this->login($pseudo,$pw);
					}
					else
					{
						session_start();
						$_SESSION['error'] = 'Veuillez saisir deux fois le même mot de passse.';

						header('refresh:0');
					}
				
				}
				else
				{
				session_start();
				$_SESSION['error'] = 'L\'adresse mail est déja utilisé.';

				header('refresh:0');
				}

			}
			else
			{
				session_start();
				$_SESSION['error'] = 'L\'adresse mail n\'est pas valide.';

				header('refresh:0');
			}
		}
		else
		{
			session_start();
			$_SESSION['error'] = 'Le nom d\'utilisateur est déja utilisé.';

			header('refresh:0');
		}
	}
}