<?php

namespace App\Services;

use App\Entity\Prospect;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;


class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendMail()
    {
        $to = "orfeodane@gmail.com";
        $content = '<p>See Twig integration for better HTML integration!</p>';
        $email = new Email();
        $email->from('hard.en2934@gmail.com')
            ->to($to)
            //     ->text()
            ->html($content);;
        $this->mailer->send($email);
    }
}