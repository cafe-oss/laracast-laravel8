<?php

namespace App\Providers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // I an use or $this->app ir app()
        app()->bind(Newsletter::class, function(){
            $mailchimp = new ApiClient();

            $mailchimp->setConfig([ 
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us14',
            ]);
            
            return new MailchimpNewsletter(
                $mailchimp  
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();
    }
}
