<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class EmailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendTextEmail($to, $subject, $text, $html, $from = 'no-reply@websociety.fr')
    {
        try {
            $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->text($text)
            ->html($html);
        
            $this->mailer->send($email);

            return true;
        } catch(Error $e) {
            return false;
        }
        
    }

    public function sendTemplatedEmail($to, $subject, $template, $context, $from = 'no-reply@websociety.fr')
    {
        try {
            $email = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate($template)
            ->context($context);
        
            $this->mailer->send($email);

            return true;
        } catch(Error $e) {
            return false;
        }
        
    }
}