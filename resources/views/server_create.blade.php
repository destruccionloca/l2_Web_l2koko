<div class="contaner-fluid" id="filter">
    <div class="container">
        <div class="row main-filter">
            <div class="col-md-12">
                <div class="page-title"><hr><span>Добавить сервер:</span></div>
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
                {{--<span class="unactive">Главная / </span><span class="active ml-1">Добавить сервер</span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {!! Form::open(["url" => route('site.server.store'),  'method' => "POST", "files" => "true"]) !!}
        <div class="row page-content-row">
            <!-- ERRORS -->
            @if (count($errors) > 0)
                    <div class="col-8">
                            <ul class="list-group">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                    </div>
            @endif
            <!-- END ERRORS -->
                <div class="col-8">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Название проекта</span> <span class="text-danger">*</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                {!! Form::text('name', old("name"), ['id'=>'name', "class" => "form-input", "required" => "", "placeholder" => "L2oko.ru"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Адрес сайта (URL)</span><span class="text-danger">*</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                {!! Form::url('link', old("link"), ['id'=>'link', "class" => "form-input", "required" => "", "placeholder" => "http://l2oko.ru"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Хроники</span><span class="text-danger">*</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                {!! Form::select('chronicle_id', $inputs["chronicles"], old("chronicle_id"), ['id'=>'chronicle_id', "class" => "form-select", "required" => ""]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Рейт</span><span class="text-danger">*</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                {{--{!! Form::text('rate', old("rate"), ['id'=>'rate', "class" => "form-input", "required" => ""]) !!}--}}
                                {!! Form::select('rate_id', $inputs["rates"], old("rate_id"), ['id'=>'rate_id', "class" => "form-select", "required" => ""]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Дата и время открытия</span><span class="text-danger">*</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                {!! Form::text('start_at', old("start_at"), ['id'=>'start_at', "class" => "form-input datepicker-here", "required" => "", "data-timepicker" => "true"]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">E-mail</span><span class="text-danger">*</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                {!! Form::email('email', old("email"), ['id'=>'email', "class" => "form-input", "required" => "", "placeholder" => "info@l2oko.ru"]) !!}
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                        {{--<div class="col-4">--}}
                            {{--<div class="form-input-block d-flex align-items-center">--}}
                                {{--<span class="form-input-title">Группа Вконтакте</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-8">--}}
                            {{--<div class="form-input-block d-flex align-items-center">--}}
                                {{--{!! Form::url('vk', old("vk"), ['id'=>'vk', "class" => "form-input", "placeholder" => "https://vk.com/l2oko"]) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="col-4"></div>
            </div>
            <div class="row page-content-row">
                <div class="col-8">
                    <div class="row p-1">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Описание проекта</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                {!! Form::textarea('description', isset($server->description)? $server->description : old("description"), ['id'=>'description', "class" => "form-textarea"]) !!}
                            </div>
                        </div>
                    </div>
                    {{--<div class="row p-1">--}}
                        {{--<div class="col-4">--}}
                            {{--<div class="form-input-block d-flex align-items-center">--}}
                                {{--<span class="form-input-title">Краткое описание проекта:</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-8">--}}
                            {{--<div class="form-input-block d-flex align-items-center">--}}
                                {{--{!! Form::textarea('short_desc', isset($server->short_desc)? $server->short_desc : old("short_desc"), ['id'=>'short_desc', "class" => "form-textarea"]) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-4">--}}
                            {{--<div class="form-input-block d-flex align-items-center">--}}
                                {{--<span class="form-input-title">Facebook</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-8">--}}
                            {{--<div class="form-input-block d-flex align-items-center">--}}
                                {{--{!! Form::url('fb', old("fb"), ['id'=>'fb', "class" => "form-input", "placeholder" => "https://www.facebook.com/l2oko/"]) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-4">--}}
                            {{--<div class="form-input-block d-flex align-items-center">--}}
                                {{--<span class="form-input-title">Twitter</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-8">--}}
                            {{--<div class="form-input-block d-flex align-items-center">--}}
                                {{--{!! Form::url('tw', old("tw"), ['id'=>'tw', "class" => "form-input", "placeholder" => "https://twitter.com/l2oko/"]) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-4">--}}
                            {{--<div class="form-input-block d-flex align-items-center">--}}
                                {{--<span class="form-input-title">ICQ</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-8">--}}
                            {{--<div class="form-input-block d-flex align-items-center">--}}
                                {{--{!! Form::text('icq', old("icq"), ['id'=>'icq', "class" => "form-input", "placeholder" => "123521351265"]) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Изображение</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                {!! Form::file('picture', old("picture"), ['id'=>'picture', "class" => "form-input"]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
            <div class="row page-content-row">
                <div class="col-8">
                    <div class="form-input-block d-flex align-items-center">
                        <input class="custom-select filter-but align-items-center" type="submit" value="Отправить">
                    </div>
                </div>
            </div>
    </div>
    {!! Form::close() !!}
</div>
</div>