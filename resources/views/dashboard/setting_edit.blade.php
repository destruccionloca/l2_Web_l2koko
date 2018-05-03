<div class="content">
    <div class="block">
        <div class="block-header block-header-default">
            <h1 class="block-title">Настройки</h1>
        </div>
        <div class="block-content">
            {!! Form::open(["url" => route('settings'), 'method' => "post", "id" => "settings", "files" => "true"]) !!}
            <div class="col-md-12">
                @foreach($settings as $key => $value)
                    @if($key == "main_pic" || $key == "last_upd" || $key == "filter_seotext")
                        @continue
                    @endif
                <div class="form-group">
                    <label for="{{$key}}">{{$key}}</label>
                    {!! Form::text($key, $value, ['id'=>$key, "class" => "form-control", "required" => ""]) !!}
                </div>
                @endforeach
                <div class="form-group">
                    <label for="text">Seo текст</label>
                    {!! Form::textarea('filter_seotext', isset($settings['filter_seotext'])? $settings['filter_seotext'] : old("filter_seotext"), ['id'=>'editor', "class" => "form-control", "required" => ""]) !!}
                </div>
                <div class="form-group">
                    <label class="col-12">Изображение на главной (1920x285)</label>
                        <div class="row items-push">
                            <div class="col-md-4 animated fadeIn">
                                <div class="options-container fx-item-zoom-in">
                                    <img class="img-fluid options-item" src="/images/bg_{{$settings['last_upd'] . $settings['main_pic']}}" alt="">
                                    <div class="options-overlay bg-black-op">
                                        <div class="options-overlay-content">
                                            <h3 class="h4 text-white mb-5">Шапка</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>Чтобы заменить изображение загрузите новое</p>
                    <label class="custom-file">
                        {!! Form::file('main_pic', ['class' => 'custom-file-input']) !!}
                        <span class="custom-file-control"></span>
                    </label>
                </div>
                <div class="form-group">
                    <input type="hidden" name="_method" value="PUT">
                    {!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>