<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class OrganisationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public $pswd;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $pswd)
    {
        $this->user = $user;
        $this->pswd = $pswd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.organisations.created', [
            'user' => $this->user,
            'password' => $this->pswd,
        ]);
    }
}
