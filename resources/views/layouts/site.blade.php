<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="description" content="{{ $description }}" />
    <meta name="keywords" content="{{ $keywords }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Stylesheets -->
    @yield('include_css_lib')
    @yield('include_last_css_lib')
    <!-- END Stylesheets -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=GA_TRACKING_ID"></script>
	<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-108132402-1');
	</script>
</head>
<body class="animated fadeIn">
<!--LiveInternet counter--><script type="text/javascript">
new Image().src = "//counter.yadro.ru/hit?r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,150))+
";"+Math.random();</script><!--/LiveInternet-->
<div class="container">
    <nav class="navbar navbar-expand-md navbar-light justify-content-between flex-wrap">
        <a class="navbar-brand" href="https://l2oko.ru"><div id="logo" ></div></a>

        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item active def-nav">
                <a class="nav-link" href="/">Главная</a>
            </li>
            <li class="nav-item dropdown def-nav">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Реклама<span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @foreach($pages as $page)
                        <a class="dropdown-item" href="{{route("site.page.show", ["page" => $page->alias])}}">{{$page->title}}</a>
                    @endforeach
                </div>
            </li>
            @foreach($pages_menu as $page_)
                <li class="nav-item def-nav">
                    <a class="nav-link" href="{{route("site.page.show", ["page" => $page_->alias])}}">{{$page_->title}}</a>
                </li>
            @endforeach
            <li class="nav-item add-nav">
                <a class="nav-link" href="{{ route('site.server.create') }}" >Добавить сервер</a>
            </li>
        </ul>


        <div class="d-inline-block d-lg-none" data-toggle="collapse" data-target="#mobile-nav" aria-controls="mobile-nav" aria-expanded="false" aria-label="Toggle navigation">
            <img src="{{ asset('images/menu-icon.svg') }}">
        </div>

        <div class="collapse mt-2" id="mobile-nav">
            <ul class="mobile-navbar">
                <li class="mobile-nav-item">
                    <a  href="/">Главная</a>
                </li>
                <li class="mobile-nav-item" data-toggle="collapse" data-target="#nav-dropdown" aria-controls="nav-dropdown" aria-expanded="false" aria-label="Dropdown">
                    <a href="#">
                        Реклама <i class="fa fa-caret-down float-right"></i>
                    </a>
                </li>
                <div class="collapse" id="nav-dropdown">
                    @foreach($pages as $page)
                        <a class="dropdown-item" href="{{route("site.page.show", ["page" => $page->alias])}}">{{$page->title}}</a>
                    @endforeach
                </div>
                @foreach($pages_menu as $page_)
                    <li class="mobile-nav-item">
                        <a href="{{route("site.page.show", ["page" => $page_->alias])}}">{{$page_->title}}</a>
                    </li>
                @endforeach
                <li class="mobile-nav-item d-flex justify-content-center">
                    <a class="btn btn-danger add-nav" href="{{ route('site.server.create') }}" >Добавить сервер</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="contaner-fluid" id="header-pic" style="background-image: url({{ asset("images/bg_" . $main_pic["last"] . $main_pic["pic"])}});">
    <div class="container">
        <div class="row header-pic-title justify-content-start align-items-end">
            <div class="col-lg-10">
                <h1>{{ $h1 }}</h1>
                <p>{{ $p }}</p>
            </div>
        </div>
    </div>
</div>
<!-- START CONTENT -->
@yield('content')
<!-- END CONTENT -->
{{--<div class="container-fluid partners">--}}
    {{--<div class="container">--}}
        {{--<div class="row justify-content-center partners-text">--}}
            {{--<hr class="col col-lg-2">--}}
            {{--<span class="col-auto our-partners">Наши партнеры</span>--}}
            {{--<hr class="col col-lg-2">--}}
        {{--</div>--}}
        {{--<div class="row justify-content-start partners-text">--}}
            {{--@foreach($partners as $partner)--}}
                {{--<div class="col-3 partner-img">--}}
                    {{--<a href="{{$partner->link}}" target="_blank"><img class="img-fluid" src="/uploads/partners/partner-{{$partner->id}}{{$partner->picture}}"></a>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="container-fluid footer">
    <div class="container">
        <div class="row footer-up-block">
            <div class="col-12 d-flex justify-content-center footer-up">
                <a href="#logo" class="to-up d-flex flex-column">
                    <img src="{{ asset('fonts/up.svg') }}">
                    <span>Вверх</span>
                </a>
            </div>
            <div class="col-6 d-flex justify-content-start footer-logo">
                <img src="{{ asset('fonts/footer-logo.svg') }}">
            </div>
            <div class="col-6 d-flex justify-content-end footer-soc">
                <a class="mt-2" href="mailto:info@l2oko.ru" target="_blank"><img src="{{ asset('fonts/mail.svg') }}"></a>
                <a class="mt-2" href="#" target="_blank"><img src="{{ asset('fonts/skype.svg') }}"></a>
                <a class="mt-2" href="https://vk.com/l2oko" target="_blank"><img src="{{ asset('fonts/vk.svg') }}"></a>
            </div>
        </div>
        <div class="row footer-first-menu">
            <div class="col-sm-4 d-flex justify-content-start footer-h1">
                <h5>l2oko.ru - l2 анонсер № 1</h5>
            </div>
            <div class="col-sm-4 d-flex justify-content-center footer-but-add">
                <a href="https://l2oko.ru/addserver" class="btn btn-danger">Добавить сервер</a>
            </div>
            <div class="col-md-4 d-flex justify-content-end footer-menu flex-wrap">
                <a href="https://l2oko.ru" >Главная</a>
                <a href="https://l2oko.ru/page/kontakty" >Контакты</a>
                <a href="" >Карта сайта</a>
            </div>
        </div>
        <div class="row footer-second-menu">
            <div class="col-sm-3 d-flex justify-content-start">
                <img src="{{ asset('fonts/ssl.svg') }}">
                <img src="{{ asset('fonts/webmoney.svg') }}">
            </div>
            <div class="col-md-9 d-flex justify-content-end footer-menu flex-wrap">
                <a href="https://l2oko.ru/page/vydelenie" >Выделение</a>
                <a href="https://l2oko.ru/page/brendirovanie">Брендирование</a>
                <a href="https://l2oko.ru/page/bannery" >Баннеры</a>
                <a href="https://l2oko.ru/page/krossposting" >Кросспостинг</a>
                <a href="https://l2oko.ru/page/spisok_luchshikh" >Список лучших</a>
            </div>
        </div>
        <div class="row footer-copi">
            <div class="col-9 d-flex justify-content-start flex-column copi">
                <p>
                    Копирование материалов запрещено. Copyright &copy; l2oko 2017-2018. All rights reserved.
                </p>
                <p>
                    Lineage ll is a trademark of NCsoft Corporation. Copyright &copy; NCsoft Corporation 2005-2018. All rights reserved.
                </p>
            </div>
            <div class="col-3 d-flex justify-content-end flex-column contact">
                <p style="text-transform: uppercase">
                    dev by <a target="_blank" href="https://vk.com/andreev_trick">trick</a>
                </p>
                <p style="text-transform: uppercase">
                    adv by <a target="_blank" style="text-transform: uppercase" href="http://wspn.ru/">wspn</a>
                </p>
            </div>
        </div>
        <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter46281285 = new Ya.Metrika2({ id:46281285, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/tag.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks2"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/46281285" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
        {{--<div class="row footer-info">--}}
            {{--<span class="info-top">L2 OKO - это удобный сервис по поиску новых серверов Л2.</span>--}}
            {{--<span class="info">Сервис помогает быть в курсе актуальной информации по новым серверам л2, чтобы начать игру в регламентированное время открытия. Функции кросспостинга в социальные сети, позволяет игрокам быть в курсе открытия новых серверов л2, даже не заходя на сайт. Удобные фильтры позволяют в считанные секунды найти нужный сервер л2 по хроникам и рейтам. --}}
{{--Для владельцев серверов л2, у нас представлены привилегии на предмет выделения в списковой форме серверов, а также массовые рассылки в социальные сети (VKontakte, Facebook, Telegram) посредством моментального автопостинга. --}}
{{--Для партнеров у нас разрабатывается первая в своем роде рекламная биржа (Аналог биржи Вконтакте), на стыке интересов игровых серверов и партнеров входящих в состав проекта, что дает новые возможности рекламной площадки консолидировать в себе методы распространения информации. --}}
{{--L2 OKO - это не просто анонсер, это рекламная площадка, которая увеличивает посещаемость серверов, помогает пользователям в одном месте, узнавать об открытии всех серверов Lineage 2, а так же позволяет зарабатывать партнерам проекта. Мы стремимся сделать открытие новых серверов л2 максимально заметным, качественным и успешным, в плане посещаемости и регистраций.</span>--}}
        {{--</div>--}}
    </div>
</div>
<!--JS-->
@yield('include_js_lib')
@yield('include_js')
<script>
    jQuery(document).ready(function(){
        // Add scrollspy to <body>
        // Add smooth scrolling on all links inside the navbar
        $(".to-up").on('click', function(event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            }  // End if
        });
    });
</script>
<!--END JS -->

@if (session('status'))
    <script>
        $(document).ready(function() {
            $.notify({
                icon: 'fa fa-check',
                title: '<strong>Успешно</strong>',
                message: '{{ session('status') }}'
            }, {
                type: 'success'
            });
        });
    </script>
@endif
@if (session('error'))
    <script>
        $(document).ready(function() {
            $.notify({
                icon: 'fa fa-warning',
                title: '<strong>Ошибка</strong>',
                {{--url: '{{session('url')}}',--}}
                message: '{{session('error')}}'
            }, {
                type: 'danger',
                timer: 100000,
                url_target: '_blank'
            });
        });
    </script>
@endif

</body>
</html>