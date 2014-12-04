<?php

namespace Dragonfly\Object;

use Dragonfly\Model\User;

class Email
{
    protected $mailer, $twig, $siteName;

    public function __construct($mailer, $twig, $siteName, $senderEmailAddress)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->siteName = $siteName;
        $this->senderEmailAddress = $senderEmailAddress;
    }

    public function sendUserApprovalNotice(User $user)
    {
        $this->mailer->send(\Swift_Message::newInstance()
            ->setSubject("Account approved in {$this->siteName}")
            ->setFrom($this->senderEmailAddress)
            ->setTo($user->getEmail())
            ->setBody($this->twig
                ->loadTemplate(':Email:userApproved.html.twig')
                ->render(['user' => $user])
            )
        );
    }
} 