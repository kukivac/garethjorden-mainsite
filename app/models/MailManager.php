<?php


namespace app\models;


class MailManager
{


    public static function sendMail(string $text, string $email, string $name)
    {
        // TODO: upravit funkci pro skutečnou funkčnost
        try{
            $to = InfoManager::getContactEmail();
            $subject = "Message from your website. ";

            $transport = (new \Swift_SmtpTransport('mail.garethjorden.com',587))
                ->setUsername("mailer@garethjorden.com")
                ->setPassword("xPassword159753");

            $mailer = new  \Swift_Mailer($transport);

            $message = (new \Swift_Message($subject))
                ->setFrom([$email => $name])
                ->setTo([$to => "Gareth Jorden"])
                ->setBody($text);

            $mailer->send($message);

        }catch (\Swift_SwiftException $exception){
                // :)
        }
    }
}