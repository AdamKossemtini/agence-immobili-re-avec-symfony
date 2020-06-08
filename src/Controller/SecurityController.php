<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController {

	/**
	 * @Route("/login", name="login")
	 * 
	 */
//cette fontcion a le role de faire l'authentification et obtenir les erreur de l'authentification
	public function login(AuthenticationUtils $authenticationUtils){
		$lastusername=$authenticationUtils->getLastUsername();//obtenir dernier nom connectè
		$error=$authenticationUtils->getLastAuthenticationError();//obtenir les erreur d'authentifiction
		return $this->render('security/login.html.twig',[
        'last_username'=>$lastusername,
        'error'=>$error
		]);

	}
}