<div class="contaner-fluid" id="filter">
    <div class="container">
        <div class="row main-filter">
            <div class="col-md-6">
                <span class="filter-title">Фильтр:</span>
                <div class="filter-but">х1000 - х2000 <span class="caret"></span></div>
                <div class="filter-but">Все хроники <span class="caret"></span></div>
                <div id="drop-filter"></div>
            </div>
            <div class="col-md-6">
                <span class="filter-title">Текущая неделя:</span>
                <ul class="filter-week">
                    @foreach($date_week as $day)
                        <li data-toggle="modal" data-target="#week" class="{{ ($day == $this_day)? "active" : ""}} px-3 py-2">{{$day}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="contaner-fluid">
    <div class="container d-flex justify-content-between flex-column flex-wrap flex-lg-row" id="main_container">
        <div class="col-lg-4 no_padding margin-tab">
            <div class="col-md-12 servers-tab no_padding">
                <div class="col-md-12 servers-tab-title"><span>Скоро откроются</span></div>
                @foreach($seven_days as $server)
                    <div class="col-md-12 servers-tab-vip paddding_for_tab">
                        <div class="vip-img"><img src="images/vip.png"></div>
                        <div class="vip-name"><span>{{$server->name}}</span></div>
                        <div class="vip-reit"><span>{{$server->rate->name}}</span></div>
                        <div class="vip-chronic"><span>{{$server->chronicle->name}}</span></div>
                        <div class="vip-date"><span>{{$server->start_at->format('m.d')}}</span></div>
                        <div class="vip-i"><span>i</span></div>
                    </div>
                @endforeach
                <div class="col-md-12 servers-tab-pre-title"><span>Через неделю и более:</span></div>
                @foreach($week as $server)
                    <div class="col-md-12 servers-tab-vip paddding_for_tab">
                        <div class="vip-img"><img src="images/vip.png"></div>
                        <div class="vip-name"><span>{{$server->name}}</span></div>
                        <div class="vip-reit"><span>{{$server->rate->name}}</span></div>
                        <div class="vip-chronic"><span>{{$server->chronicle->name}}</span></div>
                        <div class="vip-date"><span>{{$server->start_at->format('m.d')}}</span></div>
                        <div class="vip-i"><span>i</span></div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4 no_padding margin-tab">
            <div class="col-md-12 servers-tab no_padding">
                <div class="col-md-12 servers-tab-title"><span>Открылись вчера</span></div>
                @foreach($yesterday as $server)
                    <div class="col-md-12 servers-tab-vip paddding_for_tab">
                        <div class="vip-img"><img src="images/vip.png"></div>
                        <div class="vip-name"><span>{{$server->name}}</span></div>
                        <div class="vip-reit"><span>{{$server->rate->name}}</span></div>
                        <div class="vip-chronic"><span>{{$server->chronicle->name}}</span></div>
                        <div class="vip-date"><span>{{$server->start_at->format('m.d')}}</span></div>
                        <div class="vip-i"><span>i</span></div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-12 servers-tab no_padding">
                <div class="col-md-12 servers-tab-title"><span>Уже открылись</span></div>
                @foreach($opened as $server)
                    <div class="col-md-12 servers-tab-vip paddding_for_tab">
                        <div class="vip-img"><img src="images/vip.png"></div>
                        <div class="vip-name"><span>{{$server->name}}</span></div>
                        <div class="vip-reit"><span>{{$server->rate->name}}</span></div>
                        <div class="vip-chronic"><span>{{$server->chronicle->name}}</span></div>
                        <div class="vip-date"><span>{{$server->start_at->format('m.d')}}</span></div>
                        <div class="vip-i"><span>i</span></div>
                    </div>
                @endforeach
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
                <div class="d-flex justify-content-center reklama-img">
                    <img class="img-fluid" src="images/cccp.jpg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal week -->
<div class="modal fade" id="week" tabindex="-1" role="dialog" aria-labelledby="weekLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title-my" id="weekLabel">Дата открытия серверов: <span class="modal-mes">Декабрь</span> <span class="modal-day">20</span></h5>
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
<!-- END Modal week -->