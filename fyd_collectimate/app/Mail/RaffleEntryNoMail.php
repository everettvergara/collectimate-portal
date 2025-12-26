<?php

namespace App\Mail;

use App\Models\tb_raffle_tr_receipt;
use App\Models\tb_raffle_tr_receipt_entry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RaffleEntryNoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $receipt_id;

    public function __construct($receipt_id)
    {
        $this->receipt_id = $receipt_id;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Botejyu Raffle Entry Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $data = tb_raffle_tr_receipt::select('a.*', 'b.entry_no')
            ->from('tb_raffle_tr_receipt as a')
            ->join('tb_raffle_tr_receipt_entry as b', 'b.receipt_id', 'a.id')
            ->where('a.id', $this->receipt_id)->get();
        return new Content(
            view: 'mail.raffle-entry-no',
            with: [
                'data'           => $data,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
