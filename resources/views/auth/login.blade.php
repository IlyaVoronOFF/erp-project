@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                    <h3 class="card-header" style="justify-content: center;">Вход в панель управления</h3>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Ваш email<span
                                        class="text-danger">*</span></label>

                                <div class="col-md-7">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Ваш пароль<span
                                        class="text-danger">*</span></label>

                                <div class="col-md-7">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-7 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Запомнить в этом браузере?') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end"
                                    style="margin-top: 10px;">Войти как <span class="text-danger">*</span></label>

                                <div class="col-md-7">
                                    <select class="default-select form-control wide mb-3" name="email" id="email"
                                        required autofocus>
                                        <option value="0" selected disabled>
                                            {{ 'Выберите роль..' }}</option>
                                        <option value="admin@mail.ru">Администратор</option>
                                        <option value="osa@mail.ru">Руководитель 1</option>
                                        <option value="aileron@mail.ru">Руководитель 2</option>
                                        <option value="ss@mail.ru">Исполнитель 1</option>
                                        <option value="evg@mail.ru">Исполнитель 2</option>
                                    </select>
                                    <input id="password" name="password" value="" hidden>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary btn-lg" style="width: 360px;">
                                        Войти
                                    </button>

                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#email').change(function() {
            switch ($(this).val()) {
                case 'admin@mail.ru':
                    $('#password').val('111222');
                    break;
                case 'osa@mail.ru':
                    $('#password').val('memory');
                    break;
                case 'ss@mail.ru':
                    $('#password').val('123456');
                    break;
                case 'aileron@mail.ru':
                    $('#password').val('123456');
                    break;
                case 'evg@mail.ru':
                    $('#password').val('123456');
                    break;
            }
        });
    </script>
@endpush
