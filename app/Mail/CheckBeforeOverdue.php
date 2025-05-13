<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\users;
use App\Models\users_in_in;
use App\Models\DefaultConfig;

class CheckBeforeOverdue extends Mailable
{
    use Queueable, SerializesModels;
    public $idbfOver,$ImageLinklogo;  

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idbfOver,$ImageLinklogo)
    {
        $this->idbfOver = $idbfOver;
        $this->ImageLinklogo = $ImageLinklogo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $users = users::find($this->idbfOver);
        $users_in_in = users_in_in::where('id_user',$this->idbfOver)->first();
        $ImageLinklogo = $this->ImageLinklogo;
        $DefaultConfig = DefaultConfig::find(1);
        return $this->view('frontend.mailcus.mailbeforeoverdue',compact('users','users_in_in','ImageLinklogo','DefaultConfig'));
    }
}
