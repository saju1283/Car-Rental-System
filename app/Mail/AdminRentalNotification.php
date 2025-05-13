<?php

namespace App\Mail;

use App\Models\Rental;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminRentalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $rental;

    /**
     * Create a new message instance.
     *
     * @param Rental $rental
     */
    public function __construct(Rental $rental)
    {
        $this->rental = $rental;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Car Rental Notification - ' . $this->rental->car->brand . ' ' . $this->rental->car->model)
                    ->view('emails.admin_rental_notification')
                    ->with([
                        'rental' => $this->rental,
                        'car' => $this->rental->car,
                        'user' => $this->rental->user
                    ]);
    }
}