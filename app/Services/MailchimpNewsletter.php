<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;


class MailchimpNewsletter implements Newsletter
{

    // if there is a string, problem when laravel can't handle string during accessing service containers
    // public function __construct(protected ApiClient $mailchimp, protected string $foo)
    public function __construct(protected ApiClient $mailchimp)
    {
        
    }


    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');
     
        

        return $this->mailchimp->lists->addListMember( $list, [
            'email_address' => $email,
            'status' => 'subscribed',
        ]);
    }

    // moved into the appserviceprovider
    // protected function client()
    // {
    //     $mailchimp = new ApiClient();

    //     return $this->mailchimp->setConfig([ 
    //         'apiKey' => config('services.mailchimp.key'),
    //         'server' => 'us14',
    //     ]);
    // }
}
