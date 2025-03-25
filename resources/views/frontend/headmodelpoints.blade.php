@php
    $userCK_event = Auth::guard('users')->user();
    $reward_event = App\Models\RewardEvent::where('username_reward',$userCK_event->username)->where('reward_event_status',1)->first();
    if(@$reward_event&&date('Y-m-d',strtotime(@$reward_event->reward_stop))<date('Y-m-d')) {
        $reward_event->reward_event_status=4;
        $reward_event->save();
        $reward_event = App\Models\RewardEvent::where('username_reward',$userCK_event->username)->where('reward_event_status',1)->first();
    }
@endphp
<div class="modal fade" role="dialog" tabindex="-1" id="modal-points" style="margin-top: 150px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header m-h">
                <div class="h-pop">
                    <h4 class="modal-title head-pop" style="color: var(--bs-emphasis-color);">ลุ้นรับของรางวัล</h4>
                </div>
                <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
            </div>
            <div class="modal-body m-h">
                <div class="point-box-div">
                    <div class="point-box"><a href="https://line.me/R/ti/p/@343vxfsy?oat_content=url"
                            target="_blank"><img class="img-po1" src="assets/img/event_theater.png"></a></div>
                    @if(@$reward_event)
                        <div class="point-box"><a href="javascript:;" onclick="showpointsaws();" data-bs-dismiss="modal"><img class="img-po1"
                                    src="assets/img/event_theater01.png"></a></div>
                    @endif
                    <div class="point-box"><a href="{{route('frontend.rewards')}}"><img class="img-po1"
                                src="assets/img/redeem_reward.png"></a></div>
                </div>
            </div>
            <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"></div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" tabindex="-1" id="modal-pointsaws" style="margin-top: 150px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header m-h">
                <div class="h-pop">
                    <h4 class="modal-title head-pop" style="color: var(--bs-emphasis-color);">ท่านได้รับของรางวัล</h4>
                </div>
                <div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
            </div>
            <div class="modal-body m-h">
                <div class="point-box-div">
                    <div style="background-color:aliceblue;border-radius: 10px;color:black;padding:10px;">
                        <div style="text-align: center;"><b>ยินดีด้วยท่านได้รับรางวัล!</b></div>
                        <div style="padding: 10px;">{{@$reward_event->reward_what}}</div>
                        <div style="text-align: center;">กรุณาติดต่อในช่วง {{date('d-m-Y',strtotime(@$reward_event->reward_start))}} - {{date('d-m-Y',strtotime(@$reward_event->reward_stop))}}</div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer m-f" style="padding-top: 20px;padding-bottom: 30px;"></div> --}}
        </div>
    </div>
</div>

<script>
    function showpointsaws() {
        setTimeout(() => {
            var myModal = new bootstrap.Modal(document.getElementById('modal-pointsaws'));
            myModal.show(); // Opens the modal
        }, 200);
    }
</script>