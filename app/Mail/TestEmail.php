<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->queue = 'mail';
        $this->subject = 'E-mail de Teste';

        //Command to run email queues:
        //(run all queues named "mail". If it fails retry every 60 seconds, maximum 3 times)
        //php artisan queue:work --queue=mail --tries=3 --delay=60
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')->markdown('emails.test');
    }
}
