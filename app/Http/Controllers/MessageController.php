<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function envoieMail(){

            $data = [
        
                'title' => 'Mail from ItSolutionStuff.com',
        
                'body' => 'This is for testing email using smtp'
        
            ];
            Mail::to('kapiokosaidou95@gmail.com')->send(new \App\Mail\MessageMail($data));
        
            return 'mail envoyé';
        
    }
}
