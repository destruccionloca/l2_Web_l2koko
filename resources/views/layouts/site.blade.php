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
            <i style="cursor: pointer;color: #000000" class="fa fa-bars fa-2x"></i>
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
                <li class="mobile-nav-item add-nav">
                    <a href="{{ route('site.server.create') }}" >Добавить сервер</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="contaner-fluid" id="header-pic" style="background-image: url({{ asset("images/bg_" . $main_pic["last"] . $main_pic["pic"])}});">
    <div class="container">
        <div class="row header-pic-title justify-content-start align-items-end">
            <div class="col-lg-5">
                <h1>{{ $h1 }}</h1>
                <p>Анонсы игровых серверов Lineage 2</p>
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
<div class="container-fluid block-seo">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>СЕРВЕРА Л2</h2>
                <h3>СЕРВИС L2OKO</h3>
                <p>
                    Л2 ОКО помогает игрокам быть в курсе актуальной информации по новым серверам Lineage 2, чтобы начать игру в регламентированное время открытия. Функции кросспостинга в социальные сети, позволяют игрокам быть в курсе открытия новых серверов даже не заходя на сайт. Удобные фильтры позволяют в считанные секунды найти нужный сервер по хроникам и рейтам.
                    Для владельцев серверов л2, у нас представлены привилегии на предмет выделения в списковой форме серверов, а также массовые рассылки в социальные сети (VKontakte, Facebook, Telegram) посредством моментального автопостинга.
                    Для партнеров у нас разрабатывается первая в своем роде рекламная биржа (Аналог биржи Вконтакте), на стыке интересов игровых серверов и партнеров входящих в состав проекта, что дает новые возможности рекламной площадки консолидировать в себе методы распространения информации.
                </p>
                <h3>АНОНСЫ СЕРВЕРОВ ЛА2</h3>
                <p>
                    L2 OKO - это не просто анонсер, это рекламная площадка, которая увеличивает посещаемость серверов, помогает игрокам узнавать об открытии всех серверов Lineage 2, серверам привлекать игроков, а так же позволяет зарабатывать партнерам проекта. Мы стремимся сделать открытие новых серверов л2 максимально заметным, качественным и успешным, в плане посещаемости и регистраций.
                    Спасибо что выбираете нас!
                </p>
            </div>
            <div class="col-4">
                <div class="seo-img">
                    <img src="https://l2oko.ru/fonts/gamers-icons.svg">
                </div>
                <h3>ИГРОКАМ Л2</h3>
                <ul class="">
                    <li>Актуальные анонсы</li>
                    <li>Удобный фильтр</li>
                    <li>Недельный календарь</li>
                    <li>Выборка лучших серверов л2</li>
                    <li>Удобные блоки с серверами</li>
                    <li>Понятный интерфейс</li>
                    <li>Карточки серверов</li>
                    <li>Дата и время выхода</li>
                    <li>Адаптивный дизайн</li>
                    <li>Подписка на обновления</li>
                    <li>Кросспостинг в соц. сети</li>
                </ul>
            </div>
            <div class="col-4">
                <div class="seo-img">
                    <img src="https://l2oko.ru/fonts/vladelcam-icons.svg">
                </div>
                <h3>СЕРВЕРАМ Л2</h3>
                <ul class="">
                    <li>Реклама сервера</li>
                    <li>Переходы игроков</li>
                    <li>Личная карточка сервера</li>
                    <li>Кросспостинг анонса</li>
                    <li>Брендирование</li>
                    <li>Баннерная реклама</li>
                    <li>Выделение в списке</li>
                    <li>Участие в номинациях</li>
                    <li>Акции</li>
                    <li>Скидки</li>
                </ul>
            </div>
            <div class="col-4">
                <div class="seo-img">
                    <img src="https://l2oko.ru/fonts/partners-icons.svg">
                </div>
                <h3>ПАРТНЕРАМ Л2 ОКО</h3>
                <ul class="">
                    <li>Возможность зарабатывать</li>
                    <li>Владельцам групп, клиенты</li>
                    <li>Пиаробмен</li>
                    <li>Размещение логотипа</li>
                    <li>Привилегии партнерства</li>
                    <li>Акции</li>
                    <li>Скидки</li>
                </ul>
            </div>
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
                    <a href="https://t.me/l2oko" target="_blank"><div class="twitter"><i class="fa fa-telegram"></i></div></a>
                </div>
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