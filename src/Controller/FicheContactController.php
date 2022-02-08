<?php

namespace App\Controller;

use App\Classe\Mailer;
use App\Entity\FicheContact;
use App\Form\FormulaireContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheContactController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="fiche_contact")
     */
    public function index(Request $request,Mailer $mailer): Response
    {
        $contact = new FicheContact();

        $form = new FormulaireContactType();
        $form = $this->createForm(FormulaireContactType::class,$contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $contact = $form->getData();
            $this->manager->persist($contact);
            $this->manager->flush();
            $mailer->notify($contact);
            return $this->redirectToRoute('successContact');
        }

        return $this->render('fiche_contact/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/success", name="successContact")
     */
    public function successContact()
    {

        return $this->render('fiche_contact/successContact.html.twig');
    }
}
