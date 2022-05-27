<?php

namespace App\Services;

use App\Entity\Prospect;
use ContainerRF39Xff\get_Console_Command_TranslationExtract_LazyService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Twig\Environment;


class MailerService
{
    private $mailer;
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }


    public function sendMail($subject,$prospect)
    {

        $to = "orfeodane@gmail.com";
        // $content = '<p>See Twig integration for better HTML integration!</p>';
        $email = new TemplatedEmail();
        $email->from('orfeodane@gmail.com')
            ->to($to)
            // ->text()
            ->subject($subject)
            ->htmlTemplate('contact/emails.html.twig')
            ->context(['prospect'=>$prospect]);


        $this->mailer->send($email);
    }
}