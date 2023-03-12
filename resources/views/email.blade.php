<title>{{ $title }}</title>
@extends('component.master')
@section('header')
    <link rel="stylesheet" type="text/css" href="{{ url('email/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('email/fonts/iconic/css/material-design-iconic-font.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('email/vendor/animate/animate.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('email/vendor/css-hamburgers/hamburgers.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('email/vendor/animsition/css/animsition.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('email/vendor/select2/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('email/vendor/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('email/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('email/css/main.css') }}">

    <script nonce="c9bf428d-be93-4095-82bf-64da29c2b7a7">
        (function(w, d) {
            ! function(bv, bw, bx, by) {
                bv[bx] = bv[bx] || {};
                bv[bx].executed = [];
                bv.zaraz = {
                    deferred: [],
                    listeners: []
                };
                bv.zaraz.q = [];
                bv.zaraz._f = function(bz) {
                    return function() {
                        var bA = Array.prototype.slice.call(arguments);
                        bv.zaraz.q.push({
                            m: bz,
                            a: bA
                        })
                    }
                };
                for (const bB of ["track", "set", "debug"]) bv.zaraz[bB] = bv.zaraz._f(bB);
                bv.zaraz.init = () => {
                    var bC = bw.getElementsByTagName(by)[0],
                        bD = bw.createElement(by),
                        bE = bw.getElementsByTagName("title")[0];
                    bE && (bv[bx].t = bw.getElementsByTagName("title")[0].text);
                    bv[bx].x = Math.random();
                    bv[bx].w = bv.screen.width;
                    bv[bx].h = bv.screen.height;
                    bv[bx].j = bv.innerHeight;
                    bv[bx].e = bv.innerWidth;
                    bv[bx].l = bv.location.href;
                    bv[bx].r = bw.referrer;
                    bv[bx].k = bv.screen.colorDepth;
                    bv[bx].n = bw.characterSet;
                    bv[bx].o = (new Date).getTimezoneOffset();
                    if (bv.dataLayer)
                        for (const bI of Object.entries(Object.entries(dataLayer).reduce(((bJ, bK) => ({
                                ...bJ[1],
                                ...bK[1]
                            }))))) zaraz.set(bI[0], bI[1], {
                            scope: "page"
                        });
                    bv[bx].q = [];
                    for (; bv.zaraz.q.length;) {
                        const bL = bv.zaraz.q.shift();
                        bv[bx].q.push(bL)
                    }
                    bD.defer = !0;
                    for (const bM of [localStorage, sessionStorage]) Object.keys(bM || {}).filter((bO => bO
                        .startsWith("_zaraz_"))).forEach((bN => {
                        try {
                            bv[bx]["z_" + bN.slice(7)] = JSON.parse(bM.getItem(bN))
                        } catch {
                            bv[bx]["z_" + bN.slice(7)] = bM.getItem(bN)
                        }
                    }));
                    bD.referrerPolicy = "origin";
                    bD.src = "../../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(bv[
                    bx])));
                    bC.parentNode.insertBefore(bD, bC)
                };
                ["complete", "interactive"].includes(bw.readyState) ? zaraz.init() : bv.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
  
@endsection
@section('content')
    <div class="container-contact100">
        <div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422"
            data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>
        <div class="wrap-contact100">
            <form class="contact100-form validate-form" id="email-form" action="{{route('email.send')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <span class="contact100-form-title">
                    Email US
                </span>
                <div class="wrap-input100 validate-input" data-validate="Please enter your name">
                    <input class="input100" type="text" name="name" placeholder="Full Name">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Please enter email: e@a.x">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Please enter your Subject">
                    <input class="input100" type="text" name="subject" placeholder="Subject">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100">
                    <input class="input100" type="file" name="attachment" placeholder="attachment"> 
                </div>

                <div class="wrap-input100 validate-input" data-validate="Please enter your message">
                    <textarea class="input100" name="message" placeholder="Your Message"></textarea>
                    <span class="focus-input100"></span>
                </div>
                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn">
                        Send Email
                    </button>
                </div>
            </form>
            <div class="contact100-more">
                Contact our 24/7 call center: <span class="contact100-more-highlight">+001 345 6889</span>
            </div>
        </div>
    </div>
    <div id="dropDownSelect1"></div>
@endsection
@section('footer')
    <script src="{{ url('email/vendor/animsition/js/animsition.min.js') }}"></script>

    <script src="{{ url('email/vendor/bootstrap/js/popper.js') }}"></script>


    <script src="{{ url('email/vendor/select2/select2.min.js') }}"></script>

    <script src="{{ url('email/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ url('email/vendor/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ url('email/vendor/countdowntime/countdowntime.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
    <script src="{{ url('email/js/map-custom.js') }}"></script>
    <script src="{{ url('email/js/sd0d9') }}"></script>
    <script src="{{ url('email/js/main.js') }}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993"
        integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA=="
        data-cf-beacon='{"rayId":"7a641f36fcb0de57","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.2.0","si":100}'
        crossorigin="anonymous"></script>
@endsection
