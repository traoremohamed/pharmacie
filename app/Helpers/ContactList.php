<?php


namespace App\Helpers;

use vendor\mailjet\src;

use \Mailjet\Resources;

class ContactList
{
    public static function get_contact_list($nom_contact_list)
    {

        $mj = new \Mailjet\Client('a696191ca3195c41f839d579b90ba9ad', 'aed1dcdf1522531c77a039cc8ef09066', true, ['version' => 'v3']);
        $body = [
            'Name' => $nom_contact_list
        ];
        $response = $mj->post(Resources::$Contactslist, ['body' => $body]);
        $response->success() && var_dump($response->getData());

        return $response;
    }

    public static function get_contact_ajout_list($id, $nometprenom, $email)
    {

        $mj = new \Mailjet\Client('a696191ca3195c41f839d579b90ba9ad', 'aed1dcdf1522531c77a039cc8ef09066', true, ['version' => 'v3']);
        $body = [

            'Name' => $nometprenom,
            'Properties' => "object",
            'Action' => "addnoforce",
            'Email' => $email,
        ];
        $response = $mj->post(Resources::$ContactslistManagecontact, ['id' => $id, 'body' => $body]);
        $response->success() && ($response->getData());

        // return $response;
    }


    public static function get_contact_campagne_list($ID_CONTACTSLIST, $message, $objet)
    {

        $mj = new \Mailjet\Client('a696191ca3195c41f839d579b90ba9ad', 'aed1dcdf1522531c77a039cc8ef09066', true, ['version' => 'v3']);
        $body = [
            'Locale' => "fr_FR",
            'Sender' => "VICTOIRE IMMOBILIER",
            'SenderName' => "VICTOIRE IMMOBILIER",
            'SenderEmail' => "fbaguie@ldfgroupe.com",
            'Subject' => $objet,
            'ContactsListID' => $ID_CONTACTSLIST,
            'Title' => $objet,
            'TemplateID' => 1775026,
        ];
        $response = $mj->post(Resources::$Campaigndraft, ['body' => $body]);
        $response->success() && var_dump($response->getData());
        return $response;
    }

    public static function get_contact_campagne_list_add($id, $message)
    {

        $mj = new \Mailjet\Client('a696191ca3195c41f839d579b90ba9ad', 'aed1dcdf1522531c77a039cc8ef09066', true, ['version' => 'v3']);
        $body = [
            'Html-part' => "$message",
        ];
        $response = $mj->post(Resources::$CampaigndraftDetailcontent, ['id' => $id, 'body' => $body]);
        $response->success() && ($response->getData());
        return $response;
    }


    public static function get_contact_campagne_send($id)
    {
        $mj = new \Mailjet\Client('a696191ca3195c41f839d579b90ba9ad', 'aed1dcdf1522531c77a039cc8ef09066', true, ['version' => 'v3']);
        $response = $mj->post(Resources::$CampaigndraftSend, ['id' => $id]);
        $response->success() && var_dump($response->getData());
        return $response;
    }
}

