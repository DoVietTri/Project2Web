<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
use App\OrderDetail;

class ShoppingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $orderdetail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $orderdetail)
    {
        $this->order = $order;
        $this->orderdetail = $orderdetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('doviettri27091999@gmail.com')->view('mail.shopping');
    }
}
