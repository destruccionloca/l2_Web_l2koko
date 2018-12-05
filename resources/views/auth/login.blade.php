@extends('layouts.auth')
@section('content')
                <!-- Header -->
                <div class="py-30 px-5 text-center">
                    <a class="link-effect font-w700" href="/">
                        <i class="si si-eye"></i>
                        <span class="font-size-xl text-primary-dark">l2</span><span class="font-size-xl">oko</span>
                    </a>
                    <h1 class="h2 font-w700 mt-50 mb-10">Добро пожаловать</h1>
                    <h2 class="h4 font-w400 text-muted mb-0">Пожалуйста авторизуйтесь</h2>
                </div>
                <!-- END Header -->

                <!-- Sign In Form -->
                <div class="row justify-content-center px-5">
                    <div class="col-sm-8 col-md-6 col-xl-4">
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.js) -->
                        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                            {{ csrf_field() }}

                            @if (count($errors) > 0)
                                <div class="form-error-text-block">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" value="{{ old('login') }}" id="login-username" name="login">
                                        <label for="login-username">Логин</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="password" class="form-control" id="login-password" name="password">
                                        <label for="login-password">Пароль</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row gutters-tiny">
                                <div class="col-12 mb-10">
                                    <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                        <i class="si si-login mr-10"></i> Войти
                                    </button>
                                </div>
                                {{--<div class="col-sm-6 mb-5">--}}
                                    {{--<a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="op_auth_signup.html">--}}
                                        {{--<i class="fa fa-plus text-muted mr-5"></i> New Account--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6 mb-5">--}}
                                    {{--<a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="op_auth_reminder.html">--}}
                                        {{--<i class="fa fa-warning text-muted mr-5"></i> Forgot password--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Sign In Form -->
@endsection