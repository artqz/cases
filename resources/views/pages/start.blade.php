@extends('app')

@section('content')
    <div style="background-color:#c86f45; color: white;" id="features">
        <div class="container">
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="images/icons/stopwatch.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>FREE BITCOINS EVERY HOUR</h3>
                    Try your luck every hour playing our simple game and you could win up to $200 in free bitcoins!
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="images/icons/rocket.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>PROVABLY FAIR HI-LO GAME</h3>
                    Multiply your bitcoins playing a simple HI-LO game that is designed to be provably fair by using a combination of math and cryptography. Win big HI-LO jackpot prizes up to 1 bitcoin every time you play.
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="images/icons/trophy.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
                </div>
                <div style="position: relative; margin-left:90px">
                    <h3>FREE WEEKLY LOTTERY</h3>
                    Win big prizes with our weekly lottery for which you get free tickets every time you or someone referred by you plays the free bitcoin game.
                </div>
            </div>
            <div class="col-sm-6">
                <div style="position: relative;">
                    <img src="images/icons/diagram.png" style="width:70px; height:70px; position:absolute; top:20px; left:0px;" alt="stopwatch">
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