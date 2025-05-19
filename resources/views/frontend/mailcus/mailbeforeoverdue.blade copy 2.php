{{-- 
    <style>
        .button {
          background-color: #04AA6D; /* Green */
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
          border-radius: 8px;
        }
        
        .button2 {background-color: #008CBA;} /* Blue */
        .button3 {background-color: #f44336;} /* Red */ 
        .button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
        .button5 {background-color: #555555;} /* Black */
    </style>
    <style>
        a:link {
          text-decoration: none;
        }
        
        a:visited {
          text-decoration: none;
        }
        
        a:hover {
          text-decoration: none;
        }
        
        a:active {
          text-decoration: none;
        }
    </style>

    <table>
        <tr>
            <td><img src="{{$message->embed($ImageLinklogo)}}" alt="" style="width: 80px;"></td>
            <td style="font-size: 28px;"><b>แจ้งการหมดอายุของ Package ที่ใช้บริการจาก NF THEATER.</b></td>
        </tr>
        @php
            $namecus = @$users->name;
            $dateend = '<b style="color:#f44336;">'.date('d-m-Y',strtotime($users_in_in->date_end)).'</b>';
            $package = $users->package;
            // $msghows = "เรียนท่านผู้ใช้บริการ คุณ{namecus} ขณะนี้ท่านมีเวลาถึงวันที่ {dateend} ก่อนจะหมดเวลาในการต่ออายุ {package} โปรดตรวจสอบ!.";
            $msghows = $DefaultConfig->content_mail;
            $msghows = str_replace("{namecus}",$namecus,$msghows);
            $msghows = str_replace("{dateend}",$dateend,$msghows);
            $msghows = str_replace("{package}",$package,$msghows);
        @endphp
        <tr>
            <td colspan="2">
              {!!$msghows!!}
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;padding:10px;">
                <a class="button button3" href="https://www.nf-theater.com/frontlogin"
                    style="color: #e7e7e7 !important;">
                    Package ใกล้หมดอายุ
                </a>
            </td>
        </tr>
    </table> --}}

<h1>แจ้งการหมดอายุของ Package ที่ใช้บริการจาก NF THEATER.</h1>
<p>{{$msghows}}</p>
<a href="https://www.nf-theater.com/frontlogin">Package ใกล้หมดอายุ</a>