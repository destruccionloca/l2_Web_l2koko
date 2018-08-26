<div class="contaner-fluid" id="filter">
    <div class="container">
        <div class="row main-filter">
            <div class="col-md-12">
                <div class="page-title"><hr><span>{{$page->h2}}:</span></div>
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
        {{--<div class="row">--}}
            {{--<div class="col-12 page-title-2 align-items-center d-flex">--}}
                {{--<span class="unactive">Реклама / </span><span class="active ml-1">{{$page->title}}</span>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="row page-content-row">
            <div class="col-12">
                {!! $page->text !!}
            </div>
        </div>

    </div>
</div>
</div>