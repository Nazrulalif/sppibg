<?php

namespace App\Mail;

use App\Models\Panggilan_mesyuarat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuratPanggilanMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    use Queueable, SerializesModels;

    public $invitation;
    public $mesyuarat;
    public $listItems;

    public function __construct($invitation, $mesyuarat, $listItems)
    {
        $this->invitation = $invitation;
        $this->mesyuarat = $mesyuarat;
        $this->listItems = $listItems;
    }

    public function build()
    {
        return $this->view('admin.admin-email-surat-panggilan')
            ->with(['message' => $this])
            ->subject('Surat Panggilan Mesyuarat');
    }
}
