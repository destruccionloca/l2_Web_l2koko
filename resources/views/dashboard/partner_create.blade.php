<div class="content">
    <div class="block">
        <div class="block-header block-header-default">
            @if (isset($partner))
                <h1 class="block-title">{{ $partner->title }}</h1>
            @else
                <h1 class="block-title">Создание нового парнера</h1>
            @endif
        </div>
        <div class="block-content">
            {!! Form::open(["url" => (isset($partner->id)) ? route('partner.update',['partner' => $partner->id]) : route('partner.store'), 'method' => "post", "id" => "partnerCreate", "files" => "true"]) !!}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Название</label>
                    {!! Form::text('title', isset($partner->title)? $partner->title : old("title"), ['id'=>'title', "class" => "form-control", "required" => ""]) !!}
                </div>
                <div class="form-group">
                    <label for="link">Ссылка</label>
                    {!! Form::url('link', isset($partner->link)? $partner->link : old("link"), ['id'=>'link', "class" => "form-control", "required" => ""]) !!}
                </div>
                <div class="form-group">
                    <label for="alt">Alt</label>
                    {!! Form::text('alt', isset($partner->alt)? $partner->alt : old("alt"), ['id'=>'alt', "class" => "form-control", "required" => ""]) !!}
                </div>
                <div class="form-group">
                    <label for="alt">Ссылка для получения Token</label>
                    {!! Form::text('nullable', $token_get_link, ['id'=>'self', "class" => "form-control", "readonly" => "readonly"]) !!}
                </div>
                <div class="form-group">
                    <label for="alt">Token</label>
                    {!! Form::text('token', isset($partner->token)? $partner->token : old("token"), ['id'=>'alt', "class" => "form-control", "required" => ""]) !!}
                </div>
                <div class="form-group">
                    <label for="alt">Group ID</label>
                    {!! Form::text('group_id', isset($partner->group_id)? $partner->group_id : old("group_id"), ['id'=>'group_id', "class" => "form-control", "required" => ""]) !!}
                </div>
                <div class="form-group">
                    <label class="col-12">Изображение (255x90)</label>
                    @if(isset($partner->picture))
                        <div class="row items-push">
                            <div class="col-md-4 animated fadeIn">
                                <div class="options-container fx-item-zoom-in">
                                    <img class="img-fluid options-item" src="/uploads/partners/partner-{{$partner->id}}{{$partner->picture}}" alt="">
                                    <div class="options-overlay bg-black-op">
                                        <div class="options-overlay-content">
                                            <h3 class="h4 text-white mb-5">{{$partner->title}}</h3>
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
                <div class="form-group">
                @if (isset($partner))
                    <input type="hidden" name="_method" value="PUT">
                    {!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}
                @else
                    {!! Form::button('Добавить', ['class' => 'btn btn-success','type'=>'submit']) !!}
                @endif
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>