<?php

namespace App\Classe;

use App\Entity\Contact;
use Twig\Environment;

class Mailer{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;


    public function __construct(\Swift_Mailer $mailer,Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;

    }

    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('Contact :'.$contact->getNom().''.$contact->getPrenom()))
            ->setFrom($contact->getMail())
            ->setTo($contact->getDepartement()->getEmail())
            ->setReplyTo($contact->getMail())
            ->setBody($contact->getMessage());
        $this->mailer->send($message);
    }
}