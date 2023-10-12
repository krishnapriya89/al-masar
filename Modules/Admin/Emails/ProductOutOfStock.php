<?php

namespace Modules\Admin\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductOutOfStock extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $siteSettings;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product, $siteSettings)
    {
        $this->product = $product;
        $this->siteSettings = $siteSettings;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Product Out Of Stock',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin::emails.product-out-of-stock',
        );
    }
}
