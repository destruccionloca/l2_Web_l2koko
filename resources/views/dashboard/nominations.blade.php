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
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-edit mr-5"></i>Редактировать
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-trash mr-5"></i>Удалить
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-notebook mr-5"></i>Посмотреть заявки
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <img class="img-avatar img-avatar-thumb" src="assets/img/avatars/avatar11.jpg" alt="">
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-primary">
                            <div class="font-w600 text-white mb-5">{{$nomination->name}}</div>
                        </div>
                        <div class="block-content">
                            <div class="row items-push">
                                <div class="col-12">
                                    <div class="mb-5"><i class="si si-notebook fa-2x"></i></div>
                                    <div class="font-size-sm text-muted">4 Notes</div>
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