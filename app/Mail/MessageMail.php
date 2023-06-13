<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageMail extends Mailable
{
    use Queueable, SerializesModels;
    public  $dataEnseignant ;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $dataEnseignant )
    {
        $this->dataEnseignant = $dataEnseignant ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail de l\'UFR-ST / UNZ')

        ->view('emails.MessageMail');
    }
}
