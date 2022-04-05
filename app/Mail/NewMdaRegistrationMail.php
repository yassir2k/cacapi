<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewMdaRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email_, $organization_, $contactName_, $token_;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_email, $_organization, $_contactName, $_token)
    {
        //
        $this->email_ = $_email;
        $this->organization_ = $_organization;
        $this->contactName_ = $_contactName;
        $this->token_ = $_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.new-mda-registration-mail')
        ->subject('Confirm your CAC API Portal Registration');
    }
}
