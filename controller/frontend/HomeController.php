<?php



Class HomeController
{
	public function home()
	{
		require('view/frontend/homeView.php');
	}
	public function error()
	{
		require('view/frontend/errorView.php');
	}

	public function RGPD()
	{
		setcookie("RGPD","yes", time()+ (86400 * 365));

		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: accueil');
		}
	}

	public function NORGPD()
	{
		setcookie("NORGPD","no", time()+(86400 * 365));

		if (isset($_SERVER["HTTP_REFERER"]))
		{
			header('Refresh: 0 ' . $_SERVER["HTTP_REFERER"]);
		}
		else
		{
			header('Location: accueil');
		}
	}
	public function feedInsta()
	{
		require('view/frontend/feedInstagramView.php');
	}
	public function legalNotice()
	{
		require('view/frontend/legalNoticeView.php');
	}

	public function checkUser()
	{
		if (isset($_COOKIE['RGPD']))
		{
			if ($_COOKIE['ticket'] == $_SESSION['ticket'])
			{
				$ticket = session_id().microtime().rand(0, 999);
				$ticket = hash('sha512', $ticket);
				unset($_SESSION['ticket']);
				setcookie("ticket", "$ticket",time() + 60*180);

				$_SESSION['ticket'] = $ticket;
			}
			else
			{
				$_SESSION = array();
				session_destroy();
				header('Location: accueil');
			}
		}
		
	}
	
}