@extends('app')

@section('content')
    <div id="information">
        <div class="container">
            <div class="col-sm-6">
                <h2>WIN FREE RIPPLE EVERY HOUR!</h2>
                <ul>
                    <li style="padding-bottom: 10px;">WIN UP TO $200 IN FREE BITCOINS</li>
                    <li style="padding-bottom: 10px;">MULTIPLY YOUR BITCOINS PLAYING HI-LO</li>
                    <li style="padding-bottom: 10px;">WIN HI-LO JACKPOTS UP TO 1 BITCOIN</li>
                    <li style="padding-bottom: 10px;">FREE WEEKLY LOTTERY WITH BIG PRIZES</li>
                    <li style="padding-bottom: 10px;">50% REFERRAL COMMISSIONS FOR LIFE</li>
                </ul>
            </div>
            <div class="col-sm-6">
                @if (Auth::guest())
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 style="text-align:center;">CREATE AN ACCOUNT</h4>
                        <form role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}
                            <input id="ref_id" type="hidden" class="form-control" name="ref_id" value="{{ $ref }}" required>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password-confirm') }}" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation">Password confirmation</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Ripple address</label>
                                <input id="name" type="address" class="form-control" name="name" value="{{ old('name') }}" required>
                                <div style="text-align:center; margin-top: 10px;"><a href="#">DON'T HAVE A RIPPLE ADDRESS?</a></div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <div style="text-align:center;">Please complete the captcha below</div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-block">SIGN UP!</button>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                    <div><img src="//banners.mellowads.com/ads/F603C43841E7.gif" id="BannerAdImage" alt="Mellow Ads" width="300" height="250"></div><br>
                @endif
            </div>
        </div>
    </div>
    <div style="background-color:white; border-top: 1px solid #e3e3e3;" id="stats">
        <div class="container">
            <div class="col-sm-4" style="text-align:center;">
                <br>
                <div>REGISTERED USERS</div>
                <div>{{ $users }}</div>
                <br>
            </div>
            <div class="col-sm-4" style="text-align:center;">
                <br>
                <div>GAMES PLAYED</div>
                <div>{{ $plays }}</div>
                <br>
            </div>
            <div class="col-sm-4" style="text-align:center;">
                <br>
                <div>RIPPLE WON BY USERS</div>
                <div>0</div>
                <br>
            </div>
        </div>
    </div>
    <div style="background-color:#c86f45; color: white;" id="features">
        <div class="container">
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="/images/icons/stopwatch.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>FREE BITCOINS EVERY HOUR</h3>
                    Try your luck every hour playing our simple game and you could win up to $200 in free bitcoins!
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="/images/icons/rocket.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>PROVABLY FAIR HI-LO GAME</h3>
                    Multiply your bitcoins playing a simple HI-LO game that is designed to be provably fair by using a combination of math and cryptography. Win big HI-LO jackpot prizes up to 1 bitcoin every time you play.
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="/images/icons/trophy.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>FREE WEEKLY LOTTERY</h3>
                    Win big prizes with our weekly lottery for which you get free tickets every time you or someone referred by you plays the free bitcoin game.
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="/images/icons/diagram.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>GENEROUS REFERRAL PROGRAM</h3>
                    Refer your friends after signing up, and get 50% of whatever they win in addition to getting free lottery tickets every time they play.
                </div>
            </div>
        </div>
        <br>
    </div>
    <div id="what">
        <div class="container">
            <h2 style="text-align:center;">WHAT IS RIPPLE?</h2>
            <span>
                Ripple’s solution is built around an open, neutral protocol (Interledger Protocol or ILP) to power payments across different ledgers and networks globally. It offers a cryptographically secure end-to-end payment flow with transaction immutability and information redundancy. Architected to fit within a bank’s existing infrastructure, <strong>Ripple is designed to comply with risk, privacy and compliance requirements.</strong>
            </span>
            <br><br>
            <div class="row" style="text-align:center;">
                <iframe width="720" height="405" src="https://www.youtube.com/embed/Q2YHhLkOO9g" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
