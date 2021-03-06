@extends('app')

@section('title', 'Кликер - ')

@section('content')
    <div>
        @include('layouts.flash')
        {!! Breadcrumbs::render('faucet') !!}
        <div class="col-sm-6 col-md-6">
            <p>Здесь ты можешь получать клики каждые полчаса. Для получения клика необходимо подтвердить что ты человек!</p>
            <p>Клики требуются для приобретения игр и предметов Steam (Dota 2, Counter-strike: GO, Team-fortress 2).</p>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('faucet/get-click') }}">
                {{ csrf_field() }}
                <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                <br>
                <input type="submit" data-time="{{ $finishTime }}" class="btn btn-sm btn-success" value="Получить клики"/>
            </form>
            <br>
            <a class="btn btn-sm btn-primary" href="{{ url('exchange') }}">Получить Клики за Кристаллы</a>
        </div>
        <div class="col-sm-6 col-md-6">
            <iframe data-aa='494990' src='//ad.a-ads.com/494990?size=300x250' scrolling='no' style='width:300px; height:250px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>
        </div>
        <div class="col-sm-12 col-md-12">
            <br><br>
            <script type="text/javascript">
                var moevideo = moevideo || {};
                moevideo.queue = moevideo.queue || [];
                (function() {
                    var mvads = document.createElement("script");
                    mvads.async = true;
                    mvads.type = "text/javascript";
                    var useSSL = "https:" == document.location.protocol;
                    mvads.src = (useSSL ? "https:" : "http:") + "//moevideo.biz/embed/js/mvpt.min.js";
                    var node =document.getElementsByTagName("head")[0];
                    node.appendChild(mvads, node);
                })();
            </script>
        </div>
    </div>
@endsection

@section('sidebar')

    @include('widgets.buy')

    @widget('WidgetChat')

    @include('widgets.reklama')

    @include('widgets.vk')

@endsection

@section('scripts')
    <script>
        // Function called if AdBlock is not detected
        function adBlockNotDetected() {
            alert('AdBlock is not enabled');
        }
        // Function called if AdBlock is detected
        function adBlockDetected() {
            alert('Пожалуйста отключите adblock или добавьте наш сайт в исключение!');
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
            debug: false,
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
            var time = null;
            var url = "{{ url('time') }}";
            $.ajax({
                url: url,
                async: false,
                dataType: 'json',
                success: function(data) {
                    time = data.time;
                }
            });
            $('[data-time]').each(function(){

                //var s = parseInt($(this).data('time'))-parseInt(new Date().getTime()/1000);
                var s = parseInt($(this).data('time'))-time;
                if(s<0)
                    $(this).val('Получить клики').attr('class', 'btn btn-sm btn-success').prop('disabled', false);
                else{
                    s-=(h=Math.floor(s/60/60))*60*60;
                    s-=(m=Math.floor(s/60))*60;
                    $(this).val(
                            (h<10?'0'+h:h).plural(":",":",":")+
                            (m<10?'0'+m:m).plural(":",":",":")+
                            (s<10?'0'+s:s).plural("","","")
                    ).attr('class', 'btn btn-sm btn-default').prop('disabled', true);
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