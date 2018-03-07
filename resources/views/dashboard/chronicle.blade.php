
<div class="content">
    <!-- Block -->
    <div class="block">
        <!-- Draggable Items with jQueryUI (.js-draggable-items class is initialized in Codebase() -> uiHelperDraggableItems()) -->
        <!-- For more info and examples you can check out https://jqueryui.com/sortable/ and https://jqueryui.com/draggable/ -->
        <!--
            jQuery UI does not support touch events but if you would like to make it work on mobiles
            you can check out https://github.com/furf/jquery-ui-touch-punch/
        -->
        <div class="block-header block-header-default">
            <h1>Хроники серверов</h1>
            <h2 class="content-heading d-print-none">
                <button type="button" class="btn btn-sm btn-rounded btn-success float-right" data-toggle="modal" data-target="#modal-popout">Добавить</button>
            </h2>
        </div>
        <div class="block-content">
            {!! Form::open(["url" => route('chronicle.sort'), 'method' => "post", "onsubmit" => "return setOrder();"]) !!}
            <div class="row js-draggable-items">
                <ul class="draggable-column">
                    @foreach($chronicles as $chronicle)
                        <li class="block draggable-item chronicle" data-id="{{$chronicle->id}}">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">{{$chronicle->name}}</h3>
                                <div class="block-options">
                                    <a class="btn-block-option draggable-handler" href="javascript:void(0)">
                                        <i class="si si-cursor-move"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <input id="sort" type="hidden" name="sort" value="">
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    {!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}
                </div>
            </div>
        {!! Form::close() !!}
        <!-- END Draggable Items with jQueryUI -->
        </div>
    </div>
    <!-- END Block -->
</div>
<!-- END Page Content -->
<!-- Pop Out Modal -->
<div class="modal fade" id="modal-popout" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Добавить Хронику</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    {!! Form::open(["url" => route('chronicle.store'), 'method' => "post"]) !!}
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="title">Имя</label>
                            {{--маску сделать--}}
                            {!! Form::text('name', old("name"), ['id'=>'title', "class" => "form-control", "required" => ""]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::button('Добавить', ['class' => 'btn btn-success','type'=>'submit']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Pop Out Modal -->