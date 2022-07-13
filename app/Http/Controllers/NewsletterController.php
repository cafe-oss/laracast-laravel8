<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MailchimpMarketing\ApiClient;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        
        request()->validate([
            'email'=> 'required|email',
        ]);

        try {
            
            $newsletter->subscribe(request('email'));

        } catch (\Exception $th) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list because it may be invalid or is already in our list',
            ]);
        }

        return redirect('/')->with('success', 'You are now signed up for our newsletter');
    }
}
