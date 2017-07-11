<?php

namespace AALP\BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdvertController extends Controller
{
    public function viewAction($id)
    {
        return $this->render('AALPBookingBundle:Advert:view.html.twig', array('id' => $id));
    }
  
    public function viewSlugAction($slug, $year, $_format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            slug '".$slug."', créée en ".$year." et au format ".$_format."."
        );
    }
	
	// Ajoutez cette méthode :
    public function addAction(Request $request)
    {
        $session = $request->getSession();
    
        $session->getFlashBag()->add('info', 'Annonce bien enregistrée');

        $session->getFlashBag()->add('info', 'Oui oui, elle est bien enregistrée !');

    // Puis on redirige vers la page de visualisation de cette annonce
        return $this->redirectToRoute('AALP_platform_view', array('id' => 5));
    }
	
    public function indexAction()
    {
		$url = $this->generateUrl('AALP_platform_home');
		
        return new Response("L'URL de l'annonce d'id 5 est : ".$url);
	}
    public function deleteAction($id)
    {
    // Ici, on récupérera l'annonce correspondant à $id

    // Ici, on gérera la suppression de l'annonce en question

      return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }
	
}