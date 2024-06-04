<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotisYuranMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    use Queueable, SerializesModels;

    public $fees;
    public $data;
    public $id;

    public function __construct($fees, $data, $id)
    {
        $this->fees = $fees;
        $this->data = $data;
        $this->id = $id;
    }

    public function build()
    {
        return $this->view('admin.admin-email-notis-yuran')
            ->with(['message' => $this])
            ->subject('Notis Yuran PIBG');
    }
}
