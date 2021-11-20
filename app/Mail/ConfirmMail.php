<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $confirm;
    public function __construct($confirm)
    {
        $this->confirm = $confirm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@azam.tj')
            ->subject('Для завершения регистрации подтвердите свой email')
            ->markdown('mail.send_confirm_code')
            ->with(['confirm' => $this->confirm]);
    }
}
