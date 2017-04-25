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
        </div>
        <div class="col-sm-6 col-md-6">
            <iframe data-aa='496671' src='//ad.a-ads.com/496671?size=336x280' scrolling='no' style='width:336px; height:280px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>
        </div>
        <div class="col-sm-12 col-md-12">
            <br><br>
            <script type='text/javascript' id="s-b92c4c6bdbfe3d42">!function(t,e,n,o,a,c,s){t[a]=t[a]||function(){(t[a].q=t[a].q||[]).push(arguments)},t[a].l=1*new Date,c=e.createElement(n),s=e.getElementsByTagName(n)[0],c.async=1,c.src=o,s.parentNode.insertBefore(c,s)}(window,document,"script","//greeentea.ru/player/","vbm"); vbm('get', {"platformId":79078,"format":2,"align":"top","width":"550","height":"350","sig":"b92c4c6bdbfe3d42"});</script>
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