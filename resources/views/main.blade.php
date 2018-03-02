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
                    <li data-toggle="modal" data-target="#myModal" class="active">15</li>
                    <li data-toggle="modal" data-target="#myModal">16</li>
                    <li data-toggle="modal" data-target="#myModal">17</li>
                    <li data-toggle="modal" data-target="#myModal">18</li>
                    <li data-toggle="modal" data-target="#myModal">19</li>
                    <li data-toggle="modal" data-target="#myModal">20</li>
                    <li data-toggle="modal" data-target="#myModal">21</li>
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
                        <div class="vip-reit"><span>{{$server->rate}}</span></div>
                        <div class="vip-chronic"><span>{{$server->chronicles}}</span></div>
                        <div class="vip-date"><span>{{$server->date_start->format('m.d')}}</span></div>
                        <div class="vip-i"><span>i</span></div>
                    </div>
                @endforeach
                <div class="col-md-12 servers-tab-pre-title"><span>Через неделю и более:</span></div>
                @foreach($week as $server)
                    <div class="col-md-12 servers-tab-vip paddding_for_tab">
                        <div class="vip-img"><img src="images/vip.png"></div>
                        <div class="vip-name"><span>{{$server->name}}</span></div>
                        <div class="vip-reit"><span>{{$server->rate}}</span></div>
                        <div class="vip-chronic"><span>{{$server->chronicles}}</span></div>
                        <div class="vip-date"><span>{{$server->date_start->format('m.d')}}</span></div>
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
                        <div class="vip-reit"><span>{{$server->rate}}</span></div>
                        <div class="vip-chronic"><span>{{$server->chronicles}}</span></div>
                        <div class="vip-date"><span>{{$server->date_start->format('m.d')}}</span></div>
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
                        <div class="vip-reit"><span>{{$server->rate}}</span></div>
                        <div class="vip-chronic"><span>{{$server->chronicles}}</span></div>
                        <div class="vip-date"><span>{{$server->date_start->format('m.d')}}</span></div>
                        <div class="vip-i"><span>i</span></div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-3 no_padding margin-tab">
            <div class="col-md-12 tab no_padding">
                <div class="col-md-12 servers-tab-title"><span>Наши рекомендации</span></div>
                <div class="col-md-12 tab-recom no_padding">
                    <div class="recom_design_img"></div>
                    <div class="recom_cont"><span class="recom_title">Лучший дизайн проекта:</span><br /><span class="recom_name">Test.ws</span></div>
                </div>
                <div class="col-md-12 tab-recom no_padding">
                    <div class="recom_conc_img"></div>
                    <div class="recom_cont"><span class="recom_title">Лучшая концепция проекта:</span><br /><span class="recom_name">Test.ws</span></div>
                </div>
                <div class="col-md-12 tab-recom no_padding">
                    <div class="recom_work_img"></div>
                    <div class="recom_cont"><span class="recom_title">Непрерывная работа проекта:</span><br /><span class="recom_name">Test.ws</span></div>
                </div>
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
            <div class="col-md-12 tab no_padding">
                <div class="col-md-12 servers-tab-title"><span>Реклама</span></div>
                <div class="d-flex justify-content-center reklama-img">
                    <img class="img-fluid" src="images/cccp.jpg">
                </div>
            </div>
        </div>
    </div>
</div>