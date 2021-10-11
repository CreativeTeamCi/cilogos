<?php

namespace App\Mail;

use App\Models\BusinessLogo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $business_logo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BusinessLogo $business_logo)
    {
        $this->business_logo = $business_logo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(
            env('MAIL_FROM_ADDRESS', 'infos@ci-logos.com'),
            'CI-Logos'
        )
        ->subject('Soumission de Logo reussie')
        ->markdown('emails.logo_submitted',[
            'business_logo' => $this->business_logo
        ]);
    }
}
