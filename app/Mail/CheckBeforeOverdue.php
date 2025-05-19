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
    public $idbfOver,$ImageLinklogo,$subjectIS;  

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idbfOver,$ImageLinklogo,$subjectIS)
    {
        $this->idbfOver = $idbfOver;
        $this->ImageLinklogo = $ImageLinklogo;
        $this->subjectIS = $subjectIS;
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
        $namecus = @$users->name;
        $dateend = date('d-m-Y',strtotime($users_in_in->date_end));
        $package = $users->package;
        // $msghows = "เรียนท่านผู้ใช้บริการ คุณ{namecus} ขณะนี้ท่านมีเวลาถึงวันที่ {dateend} ก่อนจะหมดเวลาในการต่ออายุ {package} โปรดตรวจสอบ!.";
        $msghows = $DefaultConfig->content_mail;
        $msghows = str_replace("{namecus}",'',$msghows);
        $msghows = str_replace("{dateend}",'',$msghows);
        $msghows = str_replace("{package}",$package,$msghows);
        return $this->subject($this->subjectIS)
                ->view('frontend.mailcus.mailbeforeoverdue',compact('users','users_in_in','ImageLinklogo','DefaultConfig','msghows','dateend'));
    }
}
