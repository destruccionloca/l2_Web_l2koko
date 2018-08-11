<div class="contaner-fluid" id="filter">
    <div class="container">
        <div class="row main-filter">
            <div class="col-md-12">
                <div class="page-title"><hr><span>{{$server->name}}</span></div>
            </div>
            {{--<div class="col-md-6">--}}
            {{--<div class="page-but" data-toggle="modal" data-target="#myModal">Добавить услугу</div>--}}
            {{--<div class="page-but">Наши услуги</div>--}}
            {{--<div class="page-but">Заявка в "Наши рекомендации"</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
<div class="contaner-fluid">
    <div class="container page-content clearboth">
        <div class="row">
            <div class="col-12 page-title-2 align-items-center d-flex">
                <span class="unactive">Главная / </span><span class="active ml-1">{{$server->name}}</span>
            </div>
        </div>
        <div class="row page-content-row">
                <div class="col-12">
                    @if (isset($server->picture) && $server->picture != "default")
                        <img class="img-fluid" src="/uploads/servers/server-{{$server->id}}{{$server->picture}}?time={{$server->updated_at->format('d_h_i_s')}}" alt="{{$server->name}}">
                    @else
                        <img class="img-fluid" src="/uploads/servers/DEFAULT.png" alt="{{$server->name}}">
                    @endif
                    <h2>{{$server->name}}</h2>
                    <dl class="row">
                        <dt class="col-sm-3">Хроники</dt>
                        <dd class="col-sm-9">{{$server->chronicle->name}}</dd>

                        <dt class="col-sm-3">Рейт</dt>
                        <dd class="col-sm-9">{{$server->rate->name}}</dd>

                        <dt class="col-sm-3">Дата открытия</dt>
                        <dd class="col-sm-9">{{$server->start_at}}</dd>

                        <dt class="col-sm-3">Описание</dt>
                        <dd class="col-sm-9">{{$server->description}}</dd>
                    </dl>
                    <a href="{{$server->link}}" target="_blank" class="btn btn-outline-info">Перейти</a>
                </div>
        </div>
    </div>

</div>
</div>