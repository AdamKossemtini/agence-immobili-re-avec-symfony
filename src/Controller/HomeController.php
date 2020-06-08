<?php
namespace App\Controller;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

	/**
	 * @Route("/", name="home")
	 * @param PropertyRepository $repository
	 */
//cette fonction pour redirectionner le controller ver le twig home
	public function index(PropertyRepository $repository): Response{
		$properties = $repository->findLatest();
		return $this->render('pages/home.html.twig', ['properties' => $properties]);

	}
}