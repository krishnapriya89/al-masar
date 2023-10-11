<?php

namespace Modules\Frontend\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmationUser extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $siteSettings;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $siteSettings)
    {
        $this->order = $order;
        $this->siteSettings = $siteSettings;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation Request Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'frontend::emails.order-confirmation-user',
        );
    }
}
