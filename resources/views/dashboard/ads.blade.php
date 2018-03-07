<!-- ad Content -->
<div class="content">
    <!-- Invoice -->
    <h2 class="content-heading d-print-none">
        {!! Form::open(["url" => route('ad.create'), 'method' => "GET"]) !!}
        <button type="submit" class="btn btn-sm btn-rounded btn-success float-right">Новый блок</button>
        {!! Form::close() !!}

        Партнеры
    </h2>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title"></h3>
            <div class="block-options">
                <!-- Print ad functionality is initialized in Codebase() -> uiHelperPrint() -->
                <button type="button" class="btn-block-option" onclick="Codebase.helpers('print-page');">
                    <i class="si si-printer"></i> Печать
                </button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
        </div>
        <div class="block-content">

            <!-- Hover Table -->
            <div class="block">
                <div class="block-content">
                    <table class="table table-hover table-vcenter">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Название</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Даtа</th>
                            <th class="text-center" style="width: 100px;">Дейсtвие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ads as $ad)
                            <tr>
                                <th class="text-center" scope="row">{{$ad->id}}</th>
                                <td>{{$ad->title}}</td>
                                <td class="d-none d-sm-table-cell">
                                    {{$ad->created_at}}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        {!! Form::open(["url" => route('ad.edit',['ad' => $ad->id]), 'method' => "GET"]) !!}
                                        <button type="submit" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Редактировать">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        {!! Form::close() !!}
                                        {!! Form::open(["url" => route('ad.destroy', ["ad" => $ad->id]), 'method' => "POST", "id" => "adDelete"]) !!}
                                        <button type="submit" type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Удалить">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        {!! Form::hidden('_method', "DELETE") !!}
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Hover Table -->
        </div>
    </div>
    <!-- END Invoice -->
</div>
<!-- END ad Content -->