    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Сервера</h2>
        <div class="block">
            <div class="block-content block-content-full">
                <!-- Block Tabs Alternative Style -->
                    <!-- With Badges -->

                            <ul class="nav nav-pills push">
                                <li class="nav-item">
                                    <a class="nav-link {{ ($type == "active")? "active" : ""}}" href="{{route('dashboard.servers', ['type' => 'active'])}}">
                                        Активные <span class="badge badge-pill badge-secondary ml-5">{{$count['active']}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ($type == "moderating")? "active" : ""}}" href="{{route('dashboard.servers', ['type' => 'moderating'])}}">
                                        На модерации <span class="badge badge-pill badge-secondary ml-5">{{$count['moder']}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tooltip" title="Добавить новый" href="{{route('server.create')}}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </li>
                            </ul>

                    <!-- END With Badges -->

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
                                    <th class="d-none d-sm-table-cell" style="width: 5%;">Статус</th>
                                    <th class="text-center" style="width: 20%;">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($servers as $server)
                                    <tr>
                                        <td class="text-center">{{ $server->id }}</td>
                                        <td class="font-w600">{{ $server->name }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $server->start_at }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $server->chronicle->name }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $server->rate->name }}</td>
                                        <td class="d-none d-sm-table-cell">
                                            @if($server->status->name == "Free")
                                                <span class="badge badge-secondary">{{$server->status->name}}</span>
                                            @elseif($server->status->name == "Light")
                                                <span class="badge badge-primary">{{$server->status->name}}</span>
                                            @elseif($server->status->name == "Silver")
                                                <span class="badge badge-info">{{$server->status->name}}</span>
                                            @elseif($server->status->name == "Exlusive")
                                                <span class="badge badge-success">{{$server->status->name}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-toolbar push" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Links">
                                                    <a target="_blank" class="btn btn-secondary" href="{{$server->link}}" data-toggle="tooltip" title="Ссылка на проект">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                    <a target="_blank" class="btn btn-secondary" href="{{$server->social_vk}}" data-toggle="tooltip" title="Ссылка на VK">
                                                        <i class="fa fa-vk"></i>
                                                    </a>
                                                    <a target="_blank" class="btn btn-secondary" href="{{$server->social_fb}}" data-toggle="tooltip" title="Ссылка на Facebook">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                    <a target="_blank" class="btn btn-secondary" href="{{$server->social_icq}}" data-toggle="tooltip" title="Ссылка ICQ">
                                                        <i class="fa fa-weixin"></i>
                                                    </a>
                                                </div>
                                                    {!! Form::open(["url" => route('server.edit',['server'=>$server->alias]), 'method' => "GET"]) !!}
                                                    <div class="btn-group btn-group-sm ml-5" role="group" aria-label="Actions">
                                                    <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Редактировать">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                    {!! Form::open(["url" => route('server.destroy',['server'=>$server->alias]), 'method' => "POST"]) !!}
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
                                                    <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Удалить">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    </div>
                                                    {!! Form::hidden('_method', "DELETE") !!}
                                                    {!! Form::close() !!}
                                                @if($type == 'moderating')
                                                    {!! Form::open(["url" => route('server.active',['server'=>$server->alias]), 'method' => "POST"]) !!}
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
                                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Активировать">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </div>
                                                    {!! Form::hidden('_method', "PUT") !!}
                                                    {!! Form::close() !!}
                                                @endif
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