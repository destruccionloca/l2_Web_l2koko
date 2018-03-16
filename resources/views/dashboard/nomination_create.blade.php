<div class="content">
    <div class="block">
        <div class="block-header block-header-default">
            @if (isset($nomination))
                <h1 class="block-title">{{ $nomination->name }}</h1>
            @else
                <h1 class="block-title">Создание новой номинации</h1>
            @endif
        </div>
        <div class="block-content">
            {!! Form::open(["url" => (isset($nomination->id)) ? route('nomination.update',['nomination'=>$nomination->alias]) : route('nomination.store'), 'method' => "post", "id" => "nominationCreate", "files" => "true"]) !!}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Название</label>
                    {!! Form::text('name', isset($nomination->name)? $nomination->name : old("name"), ['id'=>'name', "class" => "form-control", "required" => ""]) !!}
                </div>
                <div class="form-group">
                    <label for="server_id">Сервер</label>
                    {!! Form::select('server_id', $inputs["servers"], isset($nomination->server_id)? $nomination->server_id : old("server_id"), ['id'=>'server_id', "class" => "js-select2 form-control", "required" => "", "data-placeholder" => isset($nomination->server_id)? $nomination->server->name : 'Выберите сервер']) !!}
                </div>
                <div class="form-group">
                    <label class="col-12">Изображение (54x54)</label>
                    @if(isset($nomination->picture))
                        <div class="row items-push">
                            <div class="col-md-4 animated fadeIn">
                                <div class="options-container fx-item-zoom-in">
                                    <img class="img-fluid options-item" src="/uploads/nominations/nomination-{{$nomination->id}}{{$nomination->picture}}" alt="">
                                    <div class="options-overlay bg-black-op">
                                        <div class="options-overlay-content">
                                            <h3 class="h4 text-white mb-5">{{$nomination->name}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>Чтобы заменить изображение загрузите новое</p>
                    @endif
                    <label class="custom-file">
                        {!! Form::file('picture', ['class' => 'custom-file-input']) !!}
                        <span class="custom-file-control"></span>
                    </label>
                </div>
                @if (isset($nomination))
                    <input type="hidden" name="_method" value="PUT">
                    {!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}
                @else
                    {!! Form::button('Добавить', ['class' => 'btn btn-success','type'=>'submit']) !!}
                @endif
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>