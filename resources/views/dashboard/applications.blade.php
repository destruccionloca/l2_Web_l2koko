<!-- Page Content -->
<div class="content">
    <h2 class="content-heading">Заявки для номинации {{$nomination->name}}</h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="block-content tab-content">
                <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th>Название</th>
                            <th>Дата открытия</th>
                            <th class="d-none d-sm-table-cell">Хроники</th>
                            <th class="d-none d-sm-table-cell">Рейты</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Статус</th>
                            <th class="text-center" style="width: 15%;">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <td class="text-center">{{ $application->id }}</td>
                                <td class="font-w600">{{ $application->server->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $application->server->start_at }}</td>
                                <td class="d-none d-sm-table-cell">{{ $application->server->chronicle->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $application->server->rate->name }}</td>
                                <td class="d-none d-sm-table-cell">
                                    @if($application->server->status->name == "Free")
                                        <span class="badge badge-secondary">{{$application->server->status->name}}</span>
                                    @elseif($application->server->status->name == "Light")
                                        <span class="badge badge-primary">{{$application->server->status->name}}</span>
                                    @elseif($application->server->status->name == "Silver")
                                        <span class="badge badge-info">{{$application->server->status->name}}</span>
                                    @elseif($application->server->status->name == "Exlusive")
                                        <span class="badge badge-success">{{$application->server->status->name}}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-toolbar push" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Links">
                                            <a target="_blank" class="btn btn-secondary" href="{{$application->server->link}}" data-toggle="tooltip" title="Ссылка на проект">
                                                <i class="fa fa-link"></i>
                                            </a>
                                            <a target="_blank" class="btn btn-secondary" href="{{$application->server->social_vk}}" data-toggle="tooltip" title="Ссылка на VK">
                                                <i class="fa fa-vk"></i>
                                            </a>
                                            <a target="_blank" class="btn btn-secondary" href="{{$application->server->social_fb}}" data-toggle="tooltip" title="Ссылка на Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                            <a target="_blank" class="btn btn-secondary" href="{{$application->server->social_icq}}" data-toggle="tooltip" title="Ссылка ICQ">
                                                <i class="fa fa-weixin"></i>
                                            </a>
                                        </div>
                                        @if(isset($nomination->server))
                                            @if($nomination->server->id == $application->server->id)
                                                {!! Form::open(["url" => route('application.delete',['application' => $application->id]), 'method' => "POST"]) !!}
                                                <div class="btn-group btn-group-sm ml-5" role="group" aria-label="Actions">
                                                    <button type="submit" class="btn btn-warning" data-toggle="tooltip" title="Убрать">
                                                        <i class="fa fa-close"></i>
                                                    </button>
                                                </div>
                                                {!! Form::hidden('_method', "DELETE") !!}
                                                {!! Form::close() !!}
                                            @else
                                                {!! Form::open(["url" => route('application.accept',['application' => $application->id]), 'method' => "POST"]) !!}
                                                <div class="btn-group btn-group-sm ml-5" role="group" aria-label="Actions">
                                                    <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Принять">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                </div>
                                                {!! Form::hidden('_method', "PUT") !!}
                                                {!! Form::close() !!}
                                            @endif
                                        @elseif(!isset($nomination->server))
                                            {!! Form::open(["url" => route('application.accept',['application' => $application->id]), 'method' => "POST"]) !!}
                                            <div class="btn-group btn-group-sm ml-5" role="group" aria-label="Actions">
                                                <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Принять">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </div>
                                            {!! Form::hidden('_method', "PUT") !!}
                                            {!! Form::close() !!}
                                        @endif
                                        {!! Form::open(["url" => route('application.destroy',['application' => $application->id]), 'method' => "POST"]) !!}
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
                                            <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Удалить">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        {!! Form::hidden('_method', "DELETE") !!}
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                {{--// @todo сделать модерацию--}}
                <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">
                    <h4 class="font-w400">Profile Content</h4>
                    <p>...</p>
                </div>
            </div>
            <!-- END Block Tabs Alternative Style -->
        </div>
    </div>
</div>
<!-- END Page Content -->