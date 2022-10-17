<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public bool $isGuest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, bool $isGuest = false)
    {
        $this->order = $order;
        $this->isGuest = $isGuest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.order.new',
        [
            'order' => $this->order,
            'isGuest' => $this->isGuest,
        ]);
    }
}
