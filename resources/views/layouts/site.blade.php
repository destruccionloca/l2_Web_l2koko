<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <link rel="icon" href="/public/images/favicon.ico" type="image/x-icon">
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
    <nav class="navbar navbar-expand-md navbar-light">
        <a class="navbar-brand" href="http://l2oko.ru"><img id="logo" src="{{ asset('images/logo.svg') }}"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
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
        </div>
    </nav>
</div>
<div class="contaner-fluid" id="header-pic" style="background-image: url({{ asset("images/bg_" . $main_pic["last"] . $main_pic["pic"])}});">
    <div class="container">
        <div class="row header-pic-title justify-content-start align-items-end">
            <div class="col-4">
                <h1>{{ $h1 }}</h1>
                <p>Анонсы игровых серверов Lineage 2</p>
            </div>
        </div>
    </div>
</div>
<!-- START CONTENT -->
@yield('content')
<!-- END CONTENT -->
<div class="container-fluid partners">
    <div class="container">
        <div class="row justify-content-center partners-text">
            <hr class="col col-lg-2">
            <span class="col-auto our-partners">Наши партнеры</span>
            <hr class="col col-lg-2">
        </div>
        <div class="row justify-content-start partners-text">
            @foreach($partners as $partner)
                <div class="col-3 partner-img">
                    <a href="{{$partner->link}}" target="_blank"><img class="img-fluid" src="/uploads/partners/partner-{{$partner->id}}{{$partner->picture}}"></a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="container-fluid footer">
    <div class="container">
        <div class="row footer-menu-block">
            <div class="col-md-9">
                <a href="https://l2oko.ru/page/uslugi " target="_blank" class="footer-menu">Реклама</a>
                <a href="https://l2oko.ru/page/partneram" target="_blank" class="footer-menu">Партнерам</a>
                <a href="{{ route('site.server.create') }}"  class="footer-menu" >Добавить сервер</a>
            </div>
            <div class="col-md-3">
                <div class="soc">
                    <a href="https://vk.com/l2oko" target="_blank"><div class="vk"><i class="fa fa-vk"></i></div></a>
                </div>
                <div class="soc">
                    <a href="https://www.facebook.com/L2OKO-182049002357540/" target="_blank"><div class="face"><i class="fa fa-facebook"></i></div></a>
                </div>
                <div class="soc">
                    <a href="http://t.me/l2oko" target="_blank"><div class="twitter"><i class="fa fa-telegram"></i></div></a>
                </div>
            </div>
        </div>
        <div class="row footer-info">
			<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter46281285 = new Ya.Metrika2({ id:46281285, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/tag.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks2"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/46281285" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
            <span class="info-top">L2 OKO - это удобный сервис по поиску новых серверов Л2.</span>
            <span class="info">Сервис помогает быть в курсе актуальной информации по новым серверам л2, чтобы начать игру в регламентированное время открытия. Функции кросспостинга в социальные сети, позволяет игрокам быть в курсе открытия новых серверов л2, даже не заходя на сайт. Удобные фильтры позволяют в считанные секунды найти нужный сервер л2 по хроникам и рейтам. 
Для владельцев серверов л2, у нас представлены привилегии на предмет выделения в списковой форме серверов, а также массовые рассылки в социальные сети (VKontakte, Facebook, Telegram) посредством моментального автопостинга. 
Для партнеров у нас разрабатывается первая в своем роде рекламная биржа (Аналог биржи Вконтакте), на стыке интересов игровых серверов и партнеров входящих в состав проекта, что дает новые возможности рекламной площадки консолидировать в себе методы распространения информации. 
L2 OKO - это не просто анонсер, это рекламная площадка, которая увеличивает посещаемость серверов, помогает пользователям в одном месте, узнавать об открытии всех серверов Lineage 2, а так же позволяет зарабатывать партнерам проекта. Мы стремимся сделать открытие новых серверов л2 максимально заметным, качественным и успешным, в плане посещаемости и регистраций.</span>
        </div>
        <div class="row footer-copi">
            <div class="col-10">
                <div class="footer-logo" src="{{ asset('images/footer_logo.png') }}"></div>
                <span class="copi-text">L2OKO.RU — новые сервера Lineage 2 © 2017 - 2018 </span>
            </div>
            <div class="col-2">
                <img class="img-fluid" src="{{ asset('images/mkarts.png') }}">
            </div>
        </div>
    </div>
</div>
<!--JS-->
@yield('include_js_lib')
@yield('include_js')
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