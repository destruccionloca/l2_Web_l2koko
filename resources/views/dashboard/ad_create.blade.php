<div class="content">
    <div class="block">
        <div class="block-header block-header-default">
            @if (isset($ad))
                <h1 class="block-title">{{ $ad->title }}</h1>
            @else
                <h1 class="block-title">Создание нового рекламного блока</h1>
            @endif
        </div>
        <div class="block-content">
            {!! Form::open(["url" => (isset($ad->id)) ? route('ad.update',['ad' => $ad->id]) : route('ad.store'), 'method' => "post", "id" => "adCreate", "files" => "true"]) !!}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">Название</label>
                    {!! Form::text('title', isset($ad->title)? $ad->title : old("title"), ['id'=>'title', "class" => "form-control", "required" => ""]) !!}
                </div>
                <div class="form-group">
                    <label for="link">Ссылка</label>
                    {!! Form::url('link', isset($ad->link)? $ad->link : old("link"), ['id'=>'link', "class" => "form-control", "required" => ""]) !!}
                </div>
                <div class="form-group">
                    <label for="alt">Alt</label>
                    {!! Form::text('alt', isset($ad->alt)? $ad->alt : old("alt"), ['id'=>'alt', "class" => "form-control", "required" => ""]) !!}
                </div>
                <div class="form-group">
                    <label class="col-12">Изображение (280x110)</label>
                    @if(isset($ad->picture))
                        <div class="row items-push">
                            <div class="col-md-4 animated fadeIn">
                                <div class="options-container fx-item-zoom-in">
                                    <img class="img-fluid options-item" src="/uploads/ads/ad-{{$ad->id}}{{$ad->picture}}" alt="">
                                    <div class="options-overlay bg-black-op">
                                        <div class="options-overlay-content">
                                            <h3 class="h4 text-white mb-5">{{$ad->title}}</h3>
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
                    @if (isset($ad))
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