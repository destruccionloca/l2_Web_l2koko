<div class="contaner-fluid" id="filter">
    <div class="container">
        <div class="row main-filter">
            <div class="col-md-6">
                <div class="page-title"><hr><span>Регистрация:</span></div>
            </div>
            <div class="col-md-6">
                <div class="page-but" data-toggle="modal" data-target="#myModal">Добавить услугу</div>
                <div class="page-but">Наши услуги</div>
                <div class="page-but">Заявка в "Наши рекомендации"</div>
            </div>
        </div>
    </div>
</div>
<div class="contaner-fluid">
    <div class="container page-content clearboth">
        <div class="row">
            <div class="col-12 page-title-2 align-items-center d-flex">
                <span class="unactive">Главная / </span><span class="active">Регистрация</span>
            </div>
        </div>
        {!! Form::open(["url" => route('site.addserver'),  'method' => "POST"]) !!}
        <div class="row page-content-row">
                <div class="col-8">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Название проекта</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <input class="form-input" type="text" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Сслыка на проект:</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <input class="form-input" type="text" name="link">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Хроники</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <select class="form-select" name="chronic">
                                    <option value="C4">C4</option>
                                    <option value="Interlude">Interlude</option>
                                    <option value="Gracia Final">Gracia Final</option>
                                    <option value="Epilogue">Epilogue</option>
                                    <option value="Freya">Freya</option>
                                    <option value="High Five">High Five</option>
                                    <option value="GOD">GOD</option>
                                    <option value="Lindvior">Lindvior</option>
                                    <option value="Ertheia">Ertheia</option>
                                    <option value="Classic">Classic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Рейт</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <input class="form-input" type="text" name="rate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Дата открытия</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <input class="form-input datepicker-here" data-timepicker="true" type="text" name="date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">E-mail</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <input class="form-input" type="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Профиль ВК</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <input class="form-input" type="text" name="vk">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
            <div class="row page-content-row">
                <div class="col-8">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Краткое описание проекта:</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <textarea rows="8" class="form-textarea" name="desc"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Группа ВК</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <input class="form-input" type="text" name="vkgroup">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Группа Facebook</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <input class="form-input" type="text" name="fb">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">Twitter</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <input class="form-input" type="text" name="tw">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-input-block d-flex align-items-center">
                                <span class="form-input-title">ICQ</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-input-block d-flex align-items-center">
                                <input class="form-input" type="text" name="icq">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
            <div class="row page-content-row">
                <div class="col-8">
                    <div class="form-input-block d-flex align-items-center">
                        <input class="custom-select filter-but d-flex align-items-center" type="submit" value="Отправить">
                    </div>
                </div>
            </div>
    </div>
    {!! Form::close() !!}
</div>
</div>