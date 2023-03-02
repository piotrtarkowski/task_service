<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;

class NewsletterService
{
    private MailerInterface $mailer;
    private TranslatorInterface $trans;

    private array $data = [];

    public function __construct(MailerInterface $mailer, TranslatorInterface $translatable)
    {
        $this->mailer = $mailer;
        $this->trans = $translatable;
    }

    public function setData(array $data = [])
    {
        $this->data = $data;
    }

    public function sendNotify()
    {


        if (array_key_exists('email', $this->data) && $this->data['email']) {
            $emailAddress = $this->data['email'];

            $email = (new Email())
                ->to($emailAddress)
                ->subject($this->trans->trans('label.newsletter.text.welcomeSubject'))
                ->text($this->trans->trans('label.newsletter.text.welcomeText'))
                ->html(sprintf('<p>%s</p>', $this->trans->trans('label.newsletter.text.welcomeText')));

            $this->mailer->send($email);

        }

    }
}