<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\AccountCreated; //import the notification class
use App\User; //import the user class to get the user to send the notification to
use Notification; //the notification facade that shall be used to send the mail notification
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    //the function to send the notofication from the notification class
    public function sendNotification()
    {
       $user = User::first()->get();
       $message = array(
            'header'=>'Hello',
            'body'=>'You have just joined our community',
            'actionText' =>'<a href=""><click here to view your dashboad</a> class="btn btn-primary btn-sm"',
            'actionUrl'=>url('/'),
            'feedback'=>'Thank you for jonining us,we hope to see you again',
            'text'=>'Thi is some kind of a test'
       );
       Notification::send($user, new AccountCreated($message));
       dd('Notification sent successfully');
       //$user->notify(new AccountCreated($message))
    }
}
