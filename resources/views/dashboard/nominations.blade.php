<!-- Page Content -->
<div class="content">
    <h2 class="content-heading d-print-none">
        {!! Form::open(["url" => route('nomination.create'), 'method' => "GET"]) !!}
        <button type="submit" class="btn btn-sm btn-rounded btn-success float-right">Новая номинация</button>
        {!! Form::close() !!}
        Номинации
    </h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row">
            @foreach($nominations as $nomination)
                <div class="col-md-4 col-xl-3">
                    <div class="block block-themed text-center">
                        <div class="block-content block-content-full block-sticky-options pt-30 bg-primary-dark">
                            <div class="block-options">
                                <div class="dropdown">
                                    <button type="button" class="btn-block-option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-fw fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{route('nomination.edit',['nomination' => $nomination->alias])}}">
                                            <i class="fa fa-fw fa-edit mr-5"></i>Редактировать
                                        </a>
                                        {!! Form::open(["url" => route('nomination.destroy',['nomination' => $nomination->alias]), 'method' => "POST"]) !!}
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa fa-fw fa-trash mr-5"></i>Удалить
                                        </button>
                                        {!! Form::hidden('_method', "DELETE") !!}
                                        {!! Form::close() !!}
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('nomination.applications', ['nomination' => $nomination->alias])}}">
                                            <i class="fa fa-fw fa-book mr-5"></i>Посмотреть заявки
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <img class="img-avatar img-avatar-thumb" src="/uploads/nominations/nomination-{{$nomination->id}}{{$nomination->picture}}" alt="">
                        </div>
                            @if(isset($nomination->server))
                            <div class="block-content block-content-full block-content-sm bg-success">
                                <div class="font-w600 text-white mb-5">{{$nomination->name}}</div>
                                    <div class="font-w600 text-white mb-5">{{$nomination->server->name}}</div>
                            @else
                            <div class="block-content block-content-full block-content-sm bg-primary">
                                <div class="font-w600 text-white mb-5">{{$nomination->name}}</div>
                                    <div class="font-w600 text-white mb-5"><br></div>
                            @endif
                        </div>
                        <div class="block-content">
                            <div class="row items-push">
                                <div class="col-12">
                                    <div class="mb-5"><i class="si si-notebook fa-2x"></i></div>
                                    <div class="font-size-sm text-muted">{{$nomination->applications->count()}} Заявок</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->