<?php
namespace App\Controller;

use App\Form\ContactType;
use App\Entity\Property;
use App\Entity\Contact;
use Symfony\Component\Form\Forms;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAware;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Notification\ContactNotification;
class PropertyController extends AbstractController {
	/**
	 *@var PropertyRepository
	 */
	private $repository;

	public function __construct(PropertyRepository $repository, EntityManagerInterface $em) {
		$this->repository = $repository;
		$this->em = $em;
	}
	/**
	 * @Route("/biens", name="property.index")
	 */

	public function index(PaginatorInterface $paginator, Request $request): Response {
		//chercher des biens 
		$search= new PropertySearch();
		$form = $this->createForm(PropertySearchType::class,$search);
		$form->handleRequest($request);
		//pagination
		$properties = $paginator->paginate(
			$this->repository->findAllVisibleQuery($search),
		$request->query->getInt('page',1),
		12
	);
		return $this->render('property/index.html.twig',
			['current_menu' => 'properties',
			'properties'=>$properties,
			'form' =>$form->createView()
			]);

	}
	/**
	 * @Route("/biens/{slug}-{id}", name="property.show",requirements={"slug":"[a-z0-9\-]*"})
	 */

	public function show(Property $property, string $slug, Request $request,ContactNotification $notification): Response {
	
		if ($property->getSlug() !== $slug) {
	
			return $this->redirectToRoute('property.show',
				['id' => $property->getId(),
					'slug' => $property->getSlug()], 301);
		}

		//creer mail pour contacter l'agence pour reserver un biens
		$contact=new Contact();
		$contact->setProperty($property);
		$form= $this->createForm(ContactType::class, $contact);
		$form-> handleRequest($request);
		if($form->isSubmitted() && $form->isValid()){
			$notification->notify($contact);
			$this->addFlash('success','votre mail bien etre envoyer');
			
			return $this->redirectToRoute('property.show',
			['id' => $property->getId(),
				'slug' => $property->getSlug()]); 
		}
		
		return $this->render('property/show.html.twig',
			['property' => $property,
				'current_menu' => 'properties',
				'form'=>$form->createView()]); 
				
		
	}
}