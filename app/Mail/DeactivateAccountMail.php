<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeactivateAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email_, $organization_, $contactName_, $time_;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_email, $_organization, $_contactName, $_time)
    {
        //
        $this->email_ = $_email;
        $this->organization_ = $_organization;
        $this->contactName_ = $_contactName;
        $this->time_ = $_time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.deactivate-account-mail')
        ->subject('CAC API Portal Account Deactivation');
    }
}
