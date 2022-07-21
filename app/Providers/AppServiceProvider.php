<?php

namespace App\Providers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Blade;

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

        
        // section 12, use the GATE to have a better authorization logic
        Gate::define('admin', function(User $user){
            return $user->username == 'jhondoe';
        });

        // create my own blade directive <@admin>
        // Blade::if('admin', function(){
        //     return request()->user()?->can('admin');
        // });
    }
}
