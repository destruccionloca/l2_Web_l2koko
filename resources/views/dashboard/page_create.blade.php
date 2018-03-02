<div class="content">
<div class="block">
    <div class="block-header block-header-default">
        @if (isset($page))
            <h1 class="block-title">{{ $page->title }}</h1>
        @else
            <h1 class="block-title">Создание новой страницы</h1>
        @endif
    </div>
    <div class="block-content">
    {!! Form::open(["url" => (isset($page->id)) ? route('page.update',['page'=>$page->alias]) : route('page.store'), 'method' => "post", "id" => "pageCreate"]) !!}
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Тема</label>
            {!! Form::text('title', isset($page->title)? $page->title : old("title"), ['id'=>'title', "class" => "form-control", "required" => ""]) !!}
        </div>
        <div class="form-group">
            <label for="keywords">Ключевые слова</label>
            {!! Form::text('keywords', isset($page->keywords)? $page->keywords : old("keywords"), ['id'=>'keywords', "class" => "form-control", "required" => ""]) !!}
        </div>
        <div class="form-group">
            <label for="desc">Краткое описание</label>
            {!! Form::textarea('desc', isset($page->desc)? $page->desc : old("desc"), ['id'=>'desc', "class" => "form-control", "required" => ""]) !!}
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            {!! Form::textarea('text', isset($page->text)? $page->text : old("text"), ['id'=>'editor', "class" => "form-control", "required" => ""]) !!}
        </div>
        @if (isset($page))
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