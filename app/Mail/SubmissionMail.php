<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sana.michael120@gmail.com')
        ->view('pages.email.index');
    }
}
