<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustConfirmMail extends Mailable
{
    use Queueable, SerializesModels;
    public $genToken,$emailconfirm,$ImageLinklogo;  // ,$base64Image

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($genToken,$emailconfirm,$ImageLinklogo)  
    {  //,$base64Image
        $this->genToken = $genToken;
        $this->emailconfirm = $emailconfirm;
        // $this->base64Image = $base64Image;
        $this->ImageLinklogo = $ImageLinklogo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "ยืนยันเมล เพื่อใช้งานกับทาง NF Streaming.";
        $genTokenIS = $this->genToken;
        $emailconfirmIS = $this->emailconfirm;
        // $base64Image = $this->base64Image;
        $ImageLinklogo = $this->ImageLinklogo;
        return $this->subject('Confirm mail.')
                    ->view('frontend.mailcus.mailtocusauto',compact('genTokenIS','emailconfirmIS','ImageLinklogo'))->subject($subject); // ,'base64Image'
    }
}
