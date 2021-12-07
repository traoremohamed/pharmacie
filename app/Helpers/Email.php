<?php
namespace App\Helpers;

use Mailjet\Resources;
use vendor\mailjet\src;

class Email
{
    public static function get_envoimail($email,$nom,$messages){


        $mj = new \Mailjet\Client('a696191ca3195c41f839d579b90ba9ad','aed1dcdf1522531c77a039cc8ef09066',true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "fbaguie@ldfgroupe.com",
                        'Name' => "VICTOIRE IMMOBILIER"
                    ],
                    'To' => [
                        [
                            'Email' => $email,
                            'Name' => $nom
                        ]
                    ],
                    'Subject' => "Greetings from Mailjet.",
                    'TextPart' => "My first Mailjet email",
                    'HTMLPart' => $messages,
                    'CustomID' => "AppGettingStartedTest"
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());

    }


    public static function get_envoimailTemplate($email, $nom, $messages, $sujet, $titre)
    {


        $mj = new \Mailjet\Client('a696191ca3195c41f839d579b90ba9ad', 'aed1dcdf1522531c77a039cc8ef09066', true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "fbaguie@ldfgroupe.com",
                        'Name' => "VICTOIRE IMMOBILIER"
                    ],
                    'To' => [
                        [
                            'Email' => $email,
                            'Name' => $nom
                        ]
                    ],
                    'Variables' => [
                        "titre" => $titre,
                        "message" => $messages,
                    ],
                    'TemplateID' => 1785911,
                    'TemplateLanguage' => true,
                    'Subject' => $sujet,

                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
        return $response;
    }


    public static function get_envoimailReclamationTemplate($nom, $messages, $sujet, $titre, $type)
    {


        $mj = new \Mailjet\Client('a696191ca3195c41f839d579b90ba9ad', 'aed1dcdf1522531c77a039cc8ef09066', true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "fbaguie@ldfgroupe.com",
                        'Name' => $nom
                    ],
                    'To' => [
                        [
                            'Email' => "yac.a@hotmail.fr",
                            'Name' => "VICTOIRE IMMOBILIER"
                        ]
                    ],
                    'Variables' => [
                        "titre" => $titre,
                        "type" => $type,
                        "message" => $messages,
                    ],
                    'TemplateID' => 1832735,
                    'TemplateLanguage' => true,
                    'Subject' => $sujet,

                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
        return $response;
    }

}
