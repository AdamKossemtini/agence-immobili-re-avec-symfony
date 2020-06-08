<?php
namespace App\Controller\Admin;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Liip\ImagineBundle\Imagine\Data\DataManager;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;



class AdminPropertyController extends AbstractController {
	/**
	 *@var PropertyRepository
	 */
	private $repository;

	public function __construct(PropertyRepository $repository,ObjectManager $em) {
		$this->repository = $repository;
		$this->em=$em;
	}

	/**
	 * @Route("/admin", name="admin.property.index")
	 * @return Symfony\Component\HttpFoundation\Response
	 */
//cette fonction pour redirectionner le controller ver le twig index
	public function index(){
		$properties = $this->repository->findAll();
		return $this->render('admin/property/index.html.twig', compact('properties'));

	}

	/**
	 * @Route("/admin/property/{id}", name="admin.property.edit",methods="GET|POST")
	 * @return Symfony\Component\HttpFoundation\Response
	 */

	public function edit(Property $property,Request $request,CacheManager $cachemanager,UploaderHelper $helper){
		//cette fonction pour editer le formulaire et l'envoyer
		$form=$this->createForm(PropertyType::class,$property);
		$form->handleRequest($request);
		if ($form->isSubmitted()&& $form->isValid()) {
			if ($property->getImageFile() instanceof UploadedFile) {
				$cachemanager->remove($helper->asset($property,'imageFile'));
			}
		$this->em->flush();
		$this->addFlash('success','Bien modifié avec succée');
		return $this->redirectToRoute('admin.property.index');//rediriger l'utilisateur vers les biens 
		}
		return $this->render('admin/property/edit.html.twig',
			['property'=>$property,
	          'form'=>$form->createView() 
	        ]);

	}
    /**
	 * @Route("/admin/crier_property/", name="admin.property.new")
	 * @param Request $request
	 * @param Property $property
     * @return Symfony\Component\HttpFoundation\Response
	 */
//cette fonction pour creer un bien
	public function add(Request $request){
		$property= new Property();
		$form=$this->createForm(PropertyType::class,$property);
		$form->handleRequest($request);
		if ($form->isSubmitted()&& $form->isValid()) {
        $this->em->persist($property);
		$this->em->flush();
		$this->addFlash('success','Bien crée avec succée');
		return $this->redirectToRoute('admin.property.index');
		}
		return $this->render('admin/property/new.html.twig',
			['property'=>$property,
	          'form'=>$form->createView() 
	        ]);

	}
	/**
	 * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
	 * @param Property $property
	 */
//cette fontion pour supprimè un bien
	public function delete(Request $request,Property $property){
if ($this->isCsrfTokenValid('delete'.$property->getId(),$request->get('_token'))) {
	     $this->em->remove($property);
		 $this->em->flush();
		 $this->addFlash('success','Bien supprimé avec succée');
			}	
		return $this->redirectToRoute('admin.property.index');


	}
	
}