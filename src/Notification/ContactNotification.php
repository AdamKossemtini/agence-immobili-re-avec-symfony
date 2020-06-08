<?php

namespace App\Notification;
use App\Entity\Contact;
use App\Entity\Option;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\PropertySearch;
use App\Entity\Property;
use Twig\Environment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class ContactNotification extends AbstractType
{
    	/**
	 *@var \Swift_Mailer
	 */

    private $mailer;
    	/**
	 * @var  Environment 
	 */

    private $renderer;
    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
    $this->mailer=$mailer;
    $this->renderer=$renderer;
    }
//cette fonction pour notifier l'agence si un utilisateur contacte l'agence
    public function notify(Contact $contact)
    {
    $message= (new \Swift_Message('Agence :' . $contact->getProperty()->getTitle()) )
    ->setFrom('adam.kossemtini@gmail.com')
    ->setTo('Contact@agence.com')
    ->setReplyTo($contact->getEmail())
    ->setBody($this->renderer->render('emails/contact.html.twig',[
        'contact'=>$contact
    ]),'text/html');

$this->mailer->send($message);

    }
  
}
