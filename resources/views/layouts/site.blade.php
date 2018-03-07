<!DOCTYPE html>
<html>
<head>
    <title>Новые сервера л2 | L2OKO</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="description" content="L2 OKO - это удобный сервис по поиску новых серверов Л2. Сервис помогает быть в курсе событий и начинать игру сразу после открытия новых серверов л2. 
Функции кросс постинга в социальные сети позволяет игрокам быть в курсе открытия новых серверов л2 даже не заходя на сайт. Удобные фильтры позволяют в считанные секунды найти нужный сервер л2 по хроникам и рейтам." />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--CSS-->
    <!-- Bootsrap -->
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">--}}
    {{--<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                    <a class="nav-link" href="http://nbasece5.bget.ru/%D1%80%D0%B5%D0%BA%D0%BB%D0%B0%D0%BC%D0%B0.html" target="_blank">Реклама</a>
                </li>
                <li class="nav-item def-nav">
                    <a class="nav-link" href="http://nbasece5.bget.ru/%D1%80%D0%B5%D0%BA%D0%BB%D0%B0%D0%BC%D0%B0.html" target="_blank">Партнерам</a>
                </li>
                <li class="nav-item def-nav">
                    <a class="nav-link" href="#">Контакты</a>
                </li>
                <li class="nav-item dropdown drop-nav">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Личный кабинет<span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item add-nav">
                    <a class="nav-link" href="{{ route('site.addserverShow') }}" >Добавить сервер</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="contaner-fluid" id="header-pic">
    <div class="container">
        <h1>Новые сервера л2</h1>
        <p>Анонсы игровых серверов Lineage 2</p>
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
        <div class="row justify-content-center partners-text">
            <div class="col">
                <img class="img-fluid" src="{{ asset('images/kassa.png') }}">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{ asset('images/kassa.png') }}">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{ asset('images/kassa.png') }}">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{ asset('images/kassa.png') }}">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{ asset('images/kassa.png') }}">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{ asset('images/kassa.png') }}">
            </div>
            <div class="col">
                <img class="img-fluid" src="{{ asset('images/kassa.png') }}">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid footer">
    <div class="container">
        <div class="row footer-menu-block">
            <div class="col-md-9">
                <a href="http://nbasece5.bget.ru/%D1%80%D0%B5%D0%BA%D0%BB%D0%B0%D0%BC%D0%B0.html " target="_blank" class="footer-menu">Реклама</a>
                <a href="http://nbasece5.bget.ru/%D1%80%D0%B5%D0%BA%D0%BB%D0%B0%D0%BC%D0%B0.html" target="_blank" class="footer-menu">Партнерам</a>
                <a href="#" class="footer-menu">Контакты</a>
                <a href="{{ route('site.addserverShow') }}"  class="footer-menu" >Добавить сервер</a>
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
            <span class="info-top">Анонсы серверов Lineage 2 – это новые сервера Lineage 2, которые составлены в список серверов с удобной навигацией по рейтам, хроникам и дате открытия линейдж 2 сервера.</span>
            <span class="info">Ни для кого не секрет, что каждый день тысячи игроков ищут новые сервера Lineage 2. Именно для этих людей, которые желают узнать дату старта интересующего их проекта, мы и решили составить анонсы серверов lineage 2, так как, если пропустить хоть на день дату открытия, то уже намного сложнее стать топовым игроком линейдж 2. Здесь вы найдете всю нужную
информацию, посмотрев в наш список серверов, который мы ежедневно актуализируем, добавляя в него самую последнюю информацию о всех открытиях. Любой самый взыскательный игрок ла2 найдет здесь то, что он хочет. Каждый день мы пополняем наш список серверов ла2, которые скоро откроются, а так же, все желающие могут добавить сервер через специальную форму. Мы постарались преподнести анонсы серверов л2 с возможностью сортировки по таким параметрам, как хроники lineage 2 сервера, рейты и дата открытия, чтобы вам было легко найти то, что вам нужно.</span>
        </div>
        <div class="row footer-copi">
            <div class="col-10">
                <div class="footer-logo"></div><br>
                <span class="copi-text">L2oko.ru — новые сервера Lineage 2 © 2016 - 2018 </span>
            </div>
            <div class="col-2">
                <img class="img-fluid" src="{{ asset('images/mkarts.png') }}">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-my" id="exampleModalLabel">Дата открытия серверов: <span class="modal-mes">Декабрь</span> <span class="modal-day">20</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <div >&times;</div>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-servers-tab">
                    <div class="col-md-12 servers-tab-vip paddding_for_tab">
                        <div class="vip-img"><img src="images/vip.png"></div>
                        <div class="vip-name"><span>Eternal.ms</span></div>
                        <div class="vip-reit"><span><9999</span></div>
                        <div class="vip-chronic"><span>Interlude</span></div>
                        <div class="vip-date"><span>04.01.17</span></div>
                        <div class="vip-i"><span>i</span></div>
                    </div>
                    <div class="col-md-12 servers-tab-vip paddding_for_tab">
                        <div class="vip-img"><img src="images/vip.png"></div>
                        <div class="vip-name"><span>Eternal.ms</span></div>
                        <div class="vip-reit"><span><9999</span></div>
                        <div class="vip-chronic"><span>Interlude</span></div>
                        <div class="vip-date"><span>04.01.17</span></div>
                        <div class="vip-i"><span>i</span></div>
                    </div>
                    <div class="col-md-12 servers-tab-prem paddding_for_tab">
                        <div class="prem-img"><img src="images/prem.png"></div>
                        <div class="prem-name"><span>Eternal.ms</span></div>
                        <div class="prem-reit"><span><9999</span></div>
                        <div class="prem-chronic"><span>Interlude</span></div>
                        <div class="prem-date"><span>04.01.17</span></div>
                        <div class="prem-i"><span>i</span></div>
                    </div>
                    <div class="col-md-12 servers-tab-prem paddding_for_tab">
                        <div class="prem-img"><img src="images/prem.png"></div>
                        <div class="prem-name"><span>Eternal.ms</span></div>
                        <div class="prem-reit"><span><9999</span></div>
                        <div class="prem-chronic"><span>Interlude</span></div>
                        <div class="prem-date"><span>04.01.17</span></div>
                        <div class="prem-i"><span>i</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--JS-->
<!--JQ-->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datepicker.min.js') }}" ></script>
</body>
</html>