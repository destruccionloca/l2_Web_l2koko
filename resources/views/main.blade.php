<div class="contaner-fluid" id="filter">
    <div class="container">
        <div class="main-filter d-flex justify-content-between justify-content-md-center justify-content-lg-between flex-row flex-md-column flex-lg-row">
            <div >
                {!! Form::open(["url" => route('site.index'), 'method' => "get", 'id' => 'filter-form', "class" => 'd-flex flex-column flex-md-row justify-content-md-center']) !!}
                <div id="div-rate" class="oko-select oko-filter-div " style="width:130px;">
                {!! Form::select('rate', $inputs["rates"], isset($rate_name)? $rate_name : old("rate"), ['id'=>'rate', "class" => "", "required" => "", "style" => "width:130px;"]) !!}
                </div>
                <div id="div-chronicles" class="oko-select oko-filter-div" style="width:130px;">
                {!! Form::select('chronicle', $inputs["chronicles"], isset($chronicle_name)? $chronicle_name : old("chronicle"), ['id'=>'chronicle', "class" => "", "required" => "" , "style" => "width:130px;"]) !!}
                </div>
                {!! Form::submit("Фильтр", ['class' => 'custom-select filter-but']) !!}
                <a href="/" class="drop-filter"></a>
                {!! Form::close() !!}
            </div>
            <div class="d-block d-md-none sepor mx-4"></div>
            <div class="d-flex justify-content-center flex-wrap">
                <span class="filter-title  mt-md-3 mt-lg-1">Текущая неделя:</span>
                <ul class="filter-week">
                    @foreach($date_week as $day => $day_servers)
                        <li data-toggle="modal" data-target="#week-{{$day}}" class="{{ ($day == $this_day)? "active" : ""}} px-2 py-2">{{$day}}</li>
                        <!-- Modal week -->
                        <div class="modal fade" id="week-{{$day}}" tabindex="-1" role="dialog" aria-labelledby="weekLabel-{{$day}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header p-4">
                                        <h5 class="modal-title-my" id="weekLabel-{{$day}}">Дата открытия серверов: <span class="modal-mes">{{$this_month}}</span> <span class="modal-day">{{$day}}</span></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <div >&times;</div>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-servers-tab">
                                            @foreach($day_servers as $day_server)
                                                <div class="col-md-12 servers-tab-{{mb_strtolower($day_server->status->name)}} paddding_for_tab">
                                                    @if($day_server->status->name == "Exlusive")
                                                        <div class="img"><img src="images/{{mb_strtolower($day_server->status->name)}}.svg"></div>
                                                    @elseif($day_server->status->name == "Silver")
                                                        <div class="img"><img src="images/{{mb_strtolower($day_server->status->name)}}.svg"></div>
                                                    @elseif($day_server->status->name == "Light")
                                                        <div class="img"><img src="images/{{mb_strtolower($day_server->status->name)}}.svg"></div>
                                                    @elseif($day_server->status->name == "Free")
                                                        <div class="img"></div>
                                                    @endif
                                                    <div class="name"><a target="_blank" href="{{route("site.server.show", ["server" => $day_server->alias])}}"><span>{{$day_server->name}}</span></a></div>
                                                    <div class="chronic"><span>{{$day_server->chronicle->name}}</span><br/><span>{{$day_server->rate->name}}</span></div>
                                                    <div class="date"><span>{{$day_server->start_at->format('d.m H:i')}}</span></div>
                                                        <a href="{{route("site.server.show", ["server" => $day_server->alias])}}"> <div class="i"><span>i</span></div></a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Modal week -->
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="contaner-fluid">
    <div class="container d-flex justify-content-between flex-column flex-wrap flex-lg-row" id="main_container">
        <div class="col-lg-8 no_padding d-flex justify-content-between flex-column flex-wrap flex-lg-row col-70">
            <div class="col-lg-6 no_padding margin-tab col-49">
                @if($servers["vipOpen"]->count() > 0)
                    <div class="col-md-12 servers-tab no_padding">
                        <div class="col-md-12 servers-tab-title"><span>VIP | СКОРО ОТКРОЮТСЯ</span></div>
                        @for($i = 4; $i >= 0; $i--)
                            @if(isset($servers["vipOpen"][$i]))
                                @foreach($servers["vipOpen"][$i] as $server)
                                    <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                        @if($server->status->name == "Exlusive")
                                            <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                        @elseif($server->status->name == "Silver")
                                            <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                        @elseif($server->status->name == "Light")
                                            <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                        @elseif($server->status->name == "Free")
                                            <div class="img"></div>
                                        @endif
                                        <div class="name"><a target="_blank" href="{{route("site.server.show", ["server" => $server->alias])}}"><span>{{$server->name}}</span></a></div>
                                        <div class="chronic"><span>{{$server->chronicle->name}}</span><br/><span>{{$server->rate->name}}</span></div>
                                        <div class="date"><span>{{$server->start_at->format('d.m H:i')}}</span></div>
                                        <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                    </div>
                                @endforeach
                            @endif
                        @endfor
                    </div>
                @endif
                    @if($servers["today"]->count() > 0)
                        <div class="col-md-12 servers-tab no_padding">
                            <div class="col-md-12 servers-tab-title"><span>СЕГОДНЯ</span></div>
                            @for($i = 4; $i >= 0; $i--)
                                @if(isset($servers["today"][$i]))
                                    @foreach($servers["today"][$i] as $server)
                                        <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                            @if($server->status->name == "Exlusive")
                                                <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                            @elseif($server->status->name == "Silver")
                                                <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                            @elseif($server->status->name == "Light")
                                                <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                            @elseif($server->status->name == "Free")
                                                <div class="img"></div>
                                            @endif
                                            <div class="name"><a target="_blank" href="{{route("site.server.show", ["server" => $server->alias])}}"><span>{{$server->name}}</span></a></div>
                                            <div class="chronic"><span>{{$server->chronicle->name}}</span><br/><span>{{$server->rate->name}}</span></div>
                                            <div class="date"><span>{{$server->start_at->format('d.m H:i')}}</span></div>
                                            <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                        </div>
                                    @endforeach
                                @endif
                            @endfor
                        </div>
                    @endif
                    @if($servers["tomorrow"]->count() > 0)
                        <div class="col-md-12 servers-tab no_padding">
                            <div class="col-md-12 servers-tab-title"><span>ЗАВТРА</span></div>
                            @for($i = 4; $i >= 0; $i--)
                                @if(isset($servers["tomorrow"][$i]))
                                    @foreach($servers["tomorrow"][$i] as $server)
                                        <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                            @if($server->status->name == "Exlusive")
                                                <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                            @elseif($server->status->name == "Silver")
                                                <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                            @elseif($server->status->name == "Light")
                                                <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                            @elseif($server->status->name == "Free")
                                                <div class="img"></div>
                                            @endif
                                            <div class="name"><a target="_blank" href="{{route("site.server.show", ["server" => $server->alias])}}"><span>{{$server->name}}</span></a></div>
                                            <div class="chronic"><span>{{$server->chronicle->name}}</span><br/><span>{{$server->rate->name}}</span></div>
                                            <div class="date"><span>{{$server->start_at->format('d.m H:i')}}</span></div>
                                                <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                        </div>
                                    @endforeach
                                @endif
                            @endfor
                        </div>
                    @endif
                <div class="col-md-12 servers-tab no_padding">
                    <div class="col-md-12 servers-tab-title"><span>СКОРО ОТКРОЮТСЯ</span></div>
                    @for($i = 4; $i >= 0; $i--)
                        @if(isset($servers["seven_days"][$i]))
                            @foreach($servers["seven_days"][$i] as $server)
                                <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                    @if($server->status->name == "Exlusive")
                                        <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                    @elseif($server->status->name == "Silver")
                                        <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                    @elseif($server->status->name == "Light")
                                        <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                    @elseif($server->status->name == "Free")
                                        <div class="img"></div>
                                    @endif
                                    <div class="name"><a target="_blank" href="{{route("site.server.show", ["server" => $server->alias])}}"><span>{{$server->name}}</span></a></div>
                                    <div class="chronic"><span>{{$server->chronicle->name}}</span><br/><span>{{$server->rate->name}}</span></div>
                                    <div class="date"><span>{{$server->start_at->format('d.m H:i')}}</span></div>
                                    <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                </div>
                            @endforeach
                        @endif
                    @endfor
                    <div class="col-md-12 servers-tab-pre-title"><span>ЧЕРЕЗ НЕДЕЛЮ И БОЛЕЕ:</span></div>
                    @for($i = 4; $i >= 0; $i--)
                        @if(isset($servers["week"][$i]))
                            @foreach($servers["week"][$i] as $server)
                                <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                    @if($server->status->name == "Exlusive")
                                        <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                    @elseif($server->status->name == "Silver")
                                        <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                    @elseif($server->status->name == "Light")
                                        <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                    @elseif($server->status->name == "Free")
                                        <div class="img"></div>
                                    @endif
                                        <div class="name"><a target="_blank" href="{{route("site.server.show", ["server" => $server->alias])}}"><span>{{$server->name}}</span></a></div>
                                    <div class="chronic"><span>{{$server->chronicle->name}}</span><br/><span>{{$server->rate->name}}</span></div>
                                    <div class="date"><span>{{$server->start_at->format('d.m H:i')}}</span></div>
                                    <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                </div>
                            @endforeach
                        @endif
                    @endfor
                </div>
            </div>
            <div class="col-lg-6 no_padding margin-tab col-49">
                @if($servers["vipOpened"]->count() > 0)
                    <div class="col-md-12 servers-tab no_padding">
                        <div class="col-md-12 servers-tab-title"><span>VIP | УЖЕ ОТКРЫЛИСЬ</span></div>
                        @for($i = 4; $i >= 0; $i--)
                            @if(isset($servers["vipOpened"][$i]))
                                @foreach($servers["vipOpened"][$i] as $server)
                                    <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                        @if($server->status->name == "Exlusive")
                                            <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                        @elseif($server->status->name == "Silver")
                                            <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                        @elseif($server->status->name == "Light")
                                            <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                        @elseif($server->status->name == "Free")
                                            <div class="img"></div>
                                        @endif
                                        <div class="name"><a target="_blank" href="{{route("site.server.show", ["server" => $server->alias])}}"><span>{{$server->name}}</span></a></div>
                                        <div class="chronic"><span>{{$server->chronicle->name}}</span><br/><span>{{$server->rate->name}}</span></div>
                                        <div class="date"><span>{{$server->start_at->format('d.m H:i')}}</span></div>
                                        <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                    </div>
                                @endforeach
                            @endif
                        @endfor
                    </div>
                @endif
                @if($servers["yesterday"]->count() > 0)
                    <div class="col-md-12 servers-tab no_padding">
                            <div class="col-md-12 servers-tab-title"><span>ОТКРЫЛИСЬ ВЧЕРА</span></div>
                            @for($i = 4; $i >= 0; $i--)
                                @if(isset($servers["yesterday"][$i]))
                                    @foreach($servers["yesterday"][$i] as $server)
                                        <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                            @if($server->status->name == "Exlusive")
                                                <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                            @elseif($server->status->name == "Silver")
                                                <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                            @elseif($server->status->name == "Light")
                                                <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                            @elseif($server->status->name == "Free")
                                                <div class="img"></div>
                                            @endif
                                                <div class="name"><a target="_blank" href="{{route("site.server.show", ["server" => $server->alias])}}"><span>{{$server->name}}</span></a></div>
                                            <div class="chronic"><span>{{$server->chronicle->name}}</span><br/><span>{{$server->rate->name}}</span></div>
                                            <div class="date"><span>{{$server->start_at->format('d.m H:i')}}</span></div>
                                            <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                        </div>
                                    @endforeach
                                @endif
                            @endfor
                    </div>
                @endif
                <div class="col-md-12 servers-tab no_padding">
                    <div class="col-md-12 servers-tab-title"><span>УЖЕ ОТКРЫЛИСЬ</span></div>
                    @for($i = 4; $i >= 0; $i--)
                        @if(isset($servers["opened"][$i]))
                            @foreach($servers["opened"][$i] as $server)
                                <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                    @if($server->status->name == "Exlusive")
                                        <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                    @elseif($server->status->name == "Silver")
                                        <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                    @elseif($server->status->name == "Light")
                                        <div class="img"><img src="https://l2oko.ru/images/{{mb_strtolower($server->status->name)}}.svg"></div>
                                    @elseif($server->status->name == "Free")
                                        <div class="img"></div>
                                    @endif
                                    <div class="name"><a target="_blank" href="{{route("site.server.show", ["server" => $server->alias])}}"><span>{{$server->name}}</span></a></div>
                                    <div class="chronic"><span>{{$server->chronicle->name}}</span><br/><span>{{$server->rate->name}}</span></div>
                                    <div class="date"><span>{{$server->start_at->format('d.m H:i')}}</span></div>
                                    <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                </div>
                            @endforeach
                        @endif
                    @endfor
                </div>
            </div>

            @if(isset($seotext))
                <div class="col-lg-8 no_padding margin-tab">
                    {!! $seotext !!}
                </div>
            @endif
            @if($this_no_filter)
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
            @endif
        </div>
        <div class="col-lg-3 col-26 no_padding margin-tab">
            <div class="col-md-12 tab no_padding">
                <div class="col-md-12 servers-tab-title"><span>НАШИ РЕКОМЕНДАЦИИ</span></div>
                @foreach($nominations as $nomination)
                    <div class="col-md-12 tab-recom no_padding text-center">
                        <div class="recom_img pt-3"><img src="/uploads/nominations/nomination-{{$nomination->id}}{{$nomination->picture}}"></div>
                        <div class="recom_cont"><span class="recom_title">{{$nomination->name}}:</span>
                            <br />
                            @if(isset($nomination->server))
                                <a href="{{route("site.server.show", ["server" => $nomination->server->alias])}}" target="_blank"><span class="recom_name">{{$nomination->server->name}}</span></a>
                            @else
                                <span class="recom_name">Место свободно</span>
                                <br />
                                <span class="badge badge-info float-right mt-3" data-toggle="modal" data-target="#nomination-{{$nomination->id}}" style="cursor: pointer">Подать заявку</span>
                                <!-- Modal app nomination -->
                                <div class="modal fade" id="nomination-{{$nomination->id}}" tabindex="-1" role="dialog" aria-labelledby="nominationLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header p-4">
                                                <h5 class="modal-title-my" id="nominationLabel">Заявка на номинацию: <span class="modal-mes">{{$nomination->name}}</span></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <div >&times;</div>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    {!! Form::open(["url" => route('site.application.store', ["nomination" => $nomination->alias]),  'method' => "POST"]) !!}
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-input-block d-flex align-items-center">
                                                                <span class="form-input-title">Ваш email</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="form-input-block d-flex align-items-center">
                                                                {!! Form::email('email', old("email"), ['id'=>'email', "class" => "form-input", "required" => ""]) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <div class="form-input-block d-flex align-items-center">
                                                                <input type="submit" value="Отправить">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Modal app nomination -->

                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-md-12 tab no_padding">
                @foreach($ads as $ad)
                <div class="d-flex justify-content-center ad-img p-2 mb-2">
                    <a href="{{$ad->link}}" target="_blank"><img alt="{{$ad->alt}}" class="img-fluid" src="/uploads/ads/ad-{{$ad->id}}{{$ad->picture}}"></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
