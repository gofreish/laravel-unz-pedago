<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailScolarite extends Mailable
{
    use Queueable, SerializesModels;
    public $dataScolirite;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataScolirite)
    {
        $this->dataScolirite=$dataScolirite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail de l\'UFR-ST / UNZ')

        ->view('emails.MailScolarite');
    }
}
