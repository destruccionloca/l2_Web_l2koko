<div class="contaner-fluid" id="filter">
    <div class="container">
        <div class="row main-filter">
            <div class="col-md-6">
                {!! Form::open(["url" => route('site.index'), 'method' => "get"]) !!}
                <span class="filter-title">Фильтр:</span>
                {!! Form::select('rate', $inputs["rates"], old("rate"), ['id'=>'rate', "class" => "custom-select filter-but", "required" => ""]) !!}
                {!! Form::select('chronicle', $inputs["chronicles"], old("chronicle"), ['id'=>'chronicle', "class" => "custom-select filter-but", "required" => ""]) !!}
                <button class="drop-filter" type="reset"></button>
                {!! Form::submit("Поиск", ['class' => 'filter-sub p-2']) !!}
                {!! Form::close() !!}
            </div>
            <div class="col-md-6">
                <span class="filter-title">Текущая неделя:</span>
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
                                                        <div class="img"><img src="images/{{mb_strtolower($day_server->status->name)}}.png"></div>
                                                    @elseif($day_server->status->name == "Silver")
                                                        <div class="img"><img src="images/{{mb_strtolower($day_server->status->name)}}.png"></div>
                                                    @elseif($day_server->status->name == "Light")
                                                        <div class="img"><img src="images/{{mb_strtolower($day_server->status->name)}}.png"></div>
                                                    @elseif($day_server->status->name == "Free")
                                                        <div class="img"></div>
                                                    @endif
                                                        <div class="name"><a target="_blank" href="{{$day_server->link}}"><span>{{$day_server->name}}</span></a></div>
                                                    <div class="reit"><span>{{$day_server->rate->name}}</span></div>
                                                    <div class="chronic"><span>{{$day_server->chronicle->name}}</span></div>
                                                    @if($day_server->start_at->format('d-m-Y') == $today)
                                                        <div class="date"><span>Сегодня</span></div>
                                                    @elseif($day_server->start_at->format('d-m-Y') == $yesterday)
                                                        <div class="date"><span>Вчера</span></div>
                                                    @else
                                                        <div class="date"><span>{{$day_server->start_at->format('m.d h:m')}}</span></div>
                                                    @endif
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

        <div class="col-lg-4 no_padding margin-tab">
            @if($servers["vipOpen"]->count() > 0)
                <div class="col-md-12 servers-tab no_padding">
                    <div class="col-md-12 servers-tab-title"><span>VIP Скоро откроются</span></div>
                    @for($i = 4; $i >= 0; $i--)
                        @if(isset($servers["vipOpen"][$i]))
                            @foreach($servers["vipOpen"][$i] as $server)
                                <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                    @if($server->status->name == "Exlusive")
                                        <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                    @elseif($server->status->name == "Silver")
                                        <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                    @elseif($server->status->name == "Light")
                                        <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                    @elseif($server->status->name == "Free")
                                        <div class="img"></div>
                                    @endif
                                    <div class="name"><a target="_blank" href="{{$server->link}}"><span>{{$server->name}}</span></a></div>
                                    <div class="reit"><span>{{$server->rate->name}}</span></div>
                                    <div class="chronic"><span>{{$server->chronicle->name}}</span></div>
                                    @if($server->start_at->format('d-m-Y') == $today)
                                        <div class="date"><span>Сегодня</span></div>
                                    @elseif($server->start_at->format('d-m-Y') == $yesterday)
                                        <div class="date"><span>Вчера</span></div>
                                    @else
                                        <div class="date"><span>{{$server->start_at->format('m.d h:m')}}</span></div>
                                    @endif
                                    <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                </div>
                            @endforeach
                        @endif
                    @endfor
                </div>
            @endif
            <div class="col-md-12 servers-tab no_padding">
                <div class="col-md-12 servers-tab-title"><span>Скоро откроются</span></div>
                @for($i = 4; $i >= 0; $i--)
                    @if(isset($servers["seven_days"][$i]))
                        @foreach($servers["seven_days"][$i] as $server)
                            <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                @if($server->status->name == "Exlusive")
                                    <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                @elseif($server->status->name == "Silver")
                                    <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                @elseif($server->status->name == "Light")
                                    <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                @elseif($server->status->name == "Free")
                                    <div class="img"></div>
                                @endif
                                <div class="name"><a target="_blank" href="{{$server->link}}"><span>{{$server->name}}</span></a></div>
                                <div class="reit"><span>{{$server->rate->name}}</span></div>
                                <div class="chronic"><span>{{$server->chronicle->name}}</span></div>
                                @if($server->start_at->format('d-m-Y') == $today)
                                    <div class="date"><span>Сегодня</span></div>
                                @elseif($server->start_at->format('d-m-Y') == $yesterday)
                                    <div class="date"><span>Вчера</span></div>
                                @else
                                    <div class="date"><span>{{$server->start_at->format('m.d h:m')}}</span></div>
                                @endif
                                <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                            </div>
                        @endforeach
                    @endif
                @endfor
                <div class="col-md-12 servers-tab-pre-title"><span>Через неделю и более:</span></div>
                @for($i = 4; $i >= 0; $i--)
                    @if(isset($servers["week"][$i]))
                        @foreach($servers["week"][$i] as $server)
                            <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                @if($server->status->name == "Exlusive")
                                    <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                @elseif($server->status->name == "Silver")
                                    <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                @elseif($server->status->name == "Light")
                                    <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                @elseif($server->status->name == "Free")
                                    <div class="img"></div>
                                @endif
                                    <div class="name"><a target="_blank" href="{{$server->link}}"><span>{{$server->name}}</span></a></div>
                                <div class="reit"><span>{{$server->rate->name}}</span></div>
                                <div class="chronic"><span>{{$server->chronicle->name}}</span></div>
                                    @if($server->start_at->format('d-m-Y') == $today)
                                        <div class="date"><span>Сегодня</span></div>
                                    @elseif($server->start_at->format('d-m-Y') == $yesterday)
                                        <div class="date"><span>Вчера</span></div>
                                    @else
                                        <div class="date"><span>{{$server->start_at->format('m.d h:m')}}</span></div>
                                    @endif
                                <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                            </div>
                        @endforeach
                    @endif
                @endfor
            </div>
        </div>
        <div class="col-lg-4 no_padding margin-tab">
            @if($servers["vipOpened"]->count() > 0)
                <div class="col-md-12 servers-tab no_padding">
                    <div class="col-md-12 servers-tab-title"><span>VIP Открылись</span></div>
                    @for($i = 4; $i >= 0; $i--)
                        @if(isset($servers["vipOpened"][$i]))
                            @foreach($servers["vipOpened"][$i] as $server)
                                <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                    @if($server->status->name == "Exlusive")
                                        <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                    @elseif($server->status->name == "Silver")
                                        <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                    @elseif($server->status->name == "Light")
                                        <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                    @elseif($server->status->name == "Free")
                                        <div class="img"></div>
                                    @endif
                                    <div class="name"><a target="_blank" href="{{$server->link}}"><span>{{$server->name}}</span></a></div>
                                    <div class="reit"><span>{{$server->rate->name}}</span></div>
                                    <div class="chronic"><span>{{$server->chronicle->name}}</span></div>
                                    @if($server->start_at->format('d-m-Y') == $today)
                                        <div class="date"><span>Сегодня</span></div>
                                    @elseif($server->start_at->format('d-m-Y') == $yesterday)
                                        <div class="date"><span>Вчера</span></div>
                                    @else
                                        <div class="date"><span>{{$server->start_at->format('m.d h:m')}}</span></div>
                                    @endif
                                    <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                </div>
                            @endforeach
                        @endif
                    @endfor
                </div>
            @endif
            @if($servers["yesterday"]->count() > 0)
                <div class="col-md-12 servers-tab no_padding">
                        <div class="col-md-12 servers-tab-title"><span>Открылись вчера</span></div>
                        @for($i = 4; $i >= 0; $i--)
                            @if(isset($servers["yesterday"][$i]))
                                @foreach($servers["yesterday"][$i] as $server)
                                    <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                        @if($server->status->name == "Exlusive")
                                            <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                        @elseif($server->status->name == "Silver")
                                            <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                        @elseif($server->status->name == "Light")
                                            <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                        @elseif($server->status->name == "Free")
                                            <div class="img"></div>
                                        @endif
                                            <div class="name"><a target="_blank" href="{{$server->link}}"><span>{{$server->name}}</span></a></div>
                                        <div class="reit"><span>{{$server->rate->name}}</span></div>
                                        <div class="chronic"><span>{{$server->chronicle->name}}</span></div>
                                            @if($server->start_at->format('d-m-Y') == $today)
                                                <div class="date"><span>Сегодня</span></div>
                                            @elseif($server->start_at->format('d-m-Y') == $yesterday)
                                                <div class="date"><span>Вчера</span></div>
                                            @else
                                                <div class="date"><span>{{$server->start_at->format('m.d h:m')}}</span></div>
                                            @endif
                                        <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                                    </div>
                                @endforeach
                            @endif
                        @endfor
                </div>
            @endif
            <div class="col-md-12 servers-tab no_padding">
                <div class="col-md-12 servers-tab-title"><span>Уже открылись</span></div>
                @for($i = 4; $i >= 0; $i--)
                    @if(isset($servers["opened"][$i]))
                        @foreach($servers["opened"][$i] as $server)
                            <div class="col-md-12 servers-tab-{{mb_strtolower($server->status->name)}} paddding_for_tab">
                                @if($server->status->name == "Exlusive")
                                    <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                @elseif($server->status->name == "Silver")
                                    <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                @elseif($server->status->name == "Light")
                                    <div class="img"><img src="images/{{mb_strtolower($server->status->name)}}.png"></div>
                                @elseif($server->status->name == "Free")
                                    <div class="img"></div>
                                @endif
                                    <div class="name"><a target="_blank" href="{{$server->link}}"><span>{{$server->name}}</span></a></div>
                                <div class="reit"><span>{{$server->rate->name}}</span></div>
                                <div class="chronic"><span>{{$server->chronicle->name}}</span></div>
                                    @if($server->start_at->format('d-m-Y') == $today)
                                        <div class="date"><span>Сегодня</span></div>
                                    @elseif($server->start_at->format('d-m-Y') == $yesterday)
                                        <div class="date"><span>Вчера</span></div>
                                    @else
                                        <div class="date"><span>{{$server->start_at->format('m.d h:m')}}</span></div>
                                    @endif
                                <a href="{{route("site.server.show", ["server" => $server->alias])}}"> <div class="i"><span>i</span></div></a>
                            </div>
                        @endforeach
                    @endif
                @endfor
            </div>
        </div>
        <div class="col-lg-3 no_padding margin-tab">
            <div class="col-md-12 tab no_padding">
                <div class="col-md-12 servers-tab-title"><span>Наши рекомендации</span></div>
                @foreach($nominations as $nomination)
                    <div class="col-md-12 tab-recom no_padding text-center">
                        <div class="recom_img pt-3"><img src="/uploads/nominations/nomination-{{$nomination->id}}{{$nomination->picture}}"></div>
                        <div class="recom_cont"><span class="recom_title">{{$nomination->name}}:</span>
                            <br />
                            @if(isset($nomination->server))
                                <span class="recom_name">{{$nomination->server->name}}</span>
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
                <div class="col-md-12 servers-tab-title"><span>Календарь</span></div>
                <div class="d-flex justify-content-center m-2">
                    <div class="datepicker-here"></div>
                </div>
            </div>
            <div class="col-md-12 tab no_padding">
                <div class="col-md-12 servers-tab-title"><span>Реклама</span></div>
                @foreach($ads as $ad)
                <div class="d-flex justify-content-center ad-img p-2 mb-2">
                    <a href="{{$ad->link}}" target="_blank"><img alt="{{$ad->alt}}" class="img-fluid" src="/uploads/ads/ad-{{$ad->id}}{{$ad->picture}}"></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
