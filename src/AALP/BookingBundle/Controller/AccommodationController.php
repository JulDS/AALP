<?php

namespace AALP\BookingBundle\Controller;

use AALP\BookingBundle\Entity\Accommodation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AALP\BookingBundle\Form\AccommodationType;
use AALP\BookingBundle\Form\ImageType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class AccommodationController extends Controller
{
    public function viewAction($id)
    {
		return $this->render('AALPBookingBundle:Accommodation:view.html.twig', array('id' => $id));
    }
  
	
    public function addAction(Request $request)
    {
        $accommodation = new Accommodation;
		$accommodation->setReference('1');
		$accommodation->setName('1');
		$accommodation->setDescription('1');
		$accommodation->setRoom(1);
		$accommodation->setVersion(1);
		$accommodation->setPrice(1);
		$accommodation->setState(1);
		$accommodation->setSimplebed(1);
		$accommodation->setDoublebed(1);
		$accommodation->setSite(1);
        $form = $this->get('form.factory')->create(AccommodationType::class, $accommodation);
        
        if ($request->isMethod('POST')) {
			$form->handleRequest($request);
			
			if ($form->isValid()) {
				$em = $this->getDoctrine()->getManager();
				$em->persist($accommodation);
				$em->flush();
				
				$request->getSession()->getFlashBag()->add('notice', 'Logement bien enregistré.');
				
				return $this->redirectToRoute('AALP_accommodation_view', array('id' => $accommodation->getId()));
			} 
		}  
		//	throw new NotFoundHttpException("step");	
		return $this->render('AALPBookingBundle:Accommodation:add.html.twig', array('form' => $form->createView()));
	}

    public function editAction($id, Request $request)
    {
        
		$em = $this->getDoctrine()->getManager();
		$accommodation = $em->getRepository('AALPBookingBundle:Accommodation')->find($id);
        
		if (null === $accommodation) {
          throw new NotFoundHttpException("Le logement d'id ".$id." n'existe pas.");
        }
        
		$form = $this->get('form.factory')->create(AccommodationType::class, $accommodation);	
        
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			// Inutile de persister ici, Doctrine connait déjà notre logement
			//$em = $this->getDoctrine()->getManager();
			$em->persist($accommodation);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Logement bien modifié.');
			return $this->redirectToRoute('AALP_accommodation_view', array('id' => $accommodation->getId()));
		}	
		
		return $this->render('AALPBookingBundle:Accommodation:edit.html.twig', array('form' => $form->createView()));
	}
    
    public function indexAction()
    {
        $listAccommodations = $this->getDoctrine()
			->getManager()
            ->getRepository('AALPBookingBundle:Accommodation')
            ->getAccommodations()
			;
		
		return $this->render('AALPBookingBundle:Accommodation:index.html.twig', array('listAccommodations' => $listAccommodations));
	}
	
    public function deleteAction($id, Request $request)
    {
        $accommodations = new Accommodation;
		$accommodation = $this->getDoctrine()
			->getManager()
            ->getRepository('AALPBookingBundle:Accommodation')
            ->find($id)
			;
        if (null === $accommodation) {
          throw new NotFoundHttpException("Le logement d'id ".$id." n'existe pas.");
        }
		// On crée un formulaire vide, qui ne contiendra que le champ CSRF
		// Cela permet de protéger la suppression d'annonce contre cette faille
		$form = $this->get('form.factory')->create();

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		  $em = $this->getDoctrine()->getManager();
		  $em->remove($accommodation);
		  $em->flush();

		  $request->getSession()->getFlashBag()->add('notice', "Le logement a bien été supprimé.");

		  return $this->redirectToRoute('AALP_accommodation');
		}
    
		return $this->render('AALPBookingBundle:Accommodation:delete.html.twig', array(
		  'accommodation' => $accommodation,
		  'form'   => $form->createView(),
		));
    }
	
}