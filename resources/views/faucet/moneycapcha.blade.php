@extends('app')

@section('title', 'Ежедневное задание - ')

@section('content')
    <div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('faucet/moneycaptcha') }}">
            <noindex>
                <div id="money_captcha_wrapper" class="money_captcha_wrapper">
                    <script type="text/javascript" src="https://moneycaptcha.ru/captcha.php?siteid=41614&charset=utf-8&button=moneycaptchasubmit"></script>
                </div> <input name="moneycaptcha_code" id="moneycaptcha_code" type="hidden" value="">
            </noindex>
            <input type="submit" id="moneycaptchasubmit" disabled="true" title="Вам необходимо правильно ответить на капчу" class="btn btn-sm btn-success" value="Получить клики">
        </form>
    </div>
@endsection