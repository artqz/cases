@extends('app')

@section('content')
    <div class="container">
        <div class="col-sm-8">
            <h3>Claim 0,25 to 0,50 Ripple coin - every 15 minutes!</h3>
            Our new Ripple faucet allows you to claim free network advertising credit, once every 15 minutes. All you need to do is click on the Claim now button below and complete a captcha to confirm that you are human. Free network advertising credit will then be added to your Ripple faucet account balance. http://vk.com/id331486668

            50% referral commission!

            <h3>50% referral commission!</h3>
            Additionally, you can earn 50% lifetime commission for any new accounts that you refer to Ripple faucet - from all faucet claims that they also make!
            <br>
            <button>Referral system details</button>
            <br>
            <br>
            You currently have <strong>{{ $countRefs }} referrals</strong> from which you have earned a total of <strong>{{ $xrpRefs }} Ripple coin</strong> referral commission
            <br>
            <div id="features">
                Плюсы Ripple
            </div>
            <iframe width="100%" height="411" src="https://www.youtube.com/embed/Q2YHhLkOO9g" frameborder="0" allowfullscreen></iframe>
            <br>
            <br>
            <div style="text-align: center">
                <form role="form" method="POST" action="{{ url('/faucet/play') }}">
                    {{ csrf_field() }}

                    <input data-time="{{ $finishDate }}" type="submit" value="Please give me Ripple">
                </form>
            </div>
        </div>
        <div class="col-sm-4">
            <img src="//banners.mellowads.com/ads/F603C43841E7.gif" id="BannerAdImage" alt="Mellow Ads" width="300" height="250">
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Function called if AdBlock is not detected
        function adBlockNotDetected() {
            alert('AdBlock is not enabled');
        }
        // Function called if AdBlock is detected
        function adBlockDetected() {
            alert('Please disable adBlock plugin');
            $('[data-time]').detach();
        }

        // Recommended audit because AdBlock lock the file 'fuckadblock.js'
        // If the file is not called, the variable does not exist 'fuckAdBlock'
        // This means that AdBlock is present
        if(typeof fuckAdBlock === 'undefined') {
            adBlockDetected();
        } else {
            fuckAdBlock.onDetected(adBlockDetected);
            fuckAdBlock.onNotDetected(adBlockNotDetected);
            // and|or
            fuckAdBlock.on(true, adBlockDetected);
            fuckAdBlock.on(false, adBlockNotDetected);
            // and|or
            fuckAdBlock.on(true, adBlockDetected).onNotDetected(adBlockNotDetected);
        }

        // Change the options
        fuckAdBlock.setOption('checkOnLoad', false);
        // and|or
        fuckAdBlock.setOption({
            debug: true,
            checkOnLoad: false,
            resetOnEnd: false
        });
    </script>
    <script>
        String.prototype.plural = Number.prototype.plural = function(a, b, c) {
            var index = this % 100;
            index = (index >=11 && index <= 14) ? 0 : (index %= 10) < 5 ? (index > 2 ? 2 : index): 0;
            return(this+[a, b, c][index]);
        }
        function downtimers(){
            $('[data-time]').each(function(){
                var s = parseInt($(this).data('time'))-parseInt(new Date().getTime()/1000);
                if(s<0)
                    $(this).val('Please give me Ripple').prop('disabled', false);
                else{
                    s-=(d=Math.floor(s/60/60/24))*24*60*60;
                    s-=(h=Math.floor(s/60/60))*60*60;
                    s-=(m=Math.floor(s/60))*60;
                    $(this).val(
                            (h<10?'0'+h:h).plural(":",":",":")+
                            (m<10?'0'+m:m).plural(":",":",":")+
                            (s<10?'0'+s:s).plural("","","")
                    ).prop('disabled', true);
                }
            });
        }
        downtimers();
        setInterval(downtimers,1000);
    </script>
@endsection
@section('style')
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
    </style>
@endsection