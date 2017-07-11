<?php

namespace AALP\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AccommodationController extends Controller
{
    public function viewAction($id)
    {
        return $this->render('AALPBookingBundle:Accommodation:view.html.twig', array('id' => $id));
    }
  
	
    public function addAction(Request $request)
    {
        // On récupère le service
        $antispam = $this->container->get('AALP_booking.antispam');
        // Je pars du principe que $text contient le texte d'un message quelconque
        $text = '1234567890';
        if ($antispam->isSpam($text)) {
            throw new \Exception('Votre message a été détecté comme spam !');
        }
    
	    // Ici le message n'est pas un spam
		return $this->render('AALPBookingBundle:Accommodation:index.html.twig', array('listAccommodations' => array()));
    }
	
    public function indexAction()
    {
		
        return $this->render('AALPBookingBundle:Accommodation:index.html.twig', array('listAccommodations' => array()));
	}
	
    public function deleteAction($id)
    {
    // Ici, on récupérera l'annonce correspondant à $id

    // Ici, on gérera la suppression de l'annonce en question

      return $this->render('OCPlatformBundle:Accommodation:delete.html.twig');
    }
	
}