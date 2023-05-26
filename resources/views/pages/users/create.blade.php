@extends('main')
@section('title') Создание пользователя @stop
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <a type="button" class="btn btn-primary btn-rounded" href="{{ route('pages.users.index') }}">
                            <span class="btn-icon-start text-primary">
                                <i class="fas fa-arrow-left color-info"></i>
                            </span>Назад
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form class="needs-validation" method="post" action="{{ route('pages.users.store') }}"
                                novalidate>
                                @csrf
                                <div class="header-errors">
                                    @include('inc.validateErrors')
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="fio">ФИО
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" id="fio" name="fio"
                                                        placeholder="ФИО клиента.." value="{{ old('fio') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="email">Почта
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Эл. почта.." value="{{ old('email') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="phone">Телефон
                                                </label>
                                                <div class="col-lg-9">
                                                    <input type="tel" class="form-control" id="phone" name="phone"
                                                        placeholder="Номер телефона.." value="{{ old('phone') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="password">Пароль
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" id="password"
                                                        name="password" placeholder="Пароль пользователя.."
                                                        value="{{ old('password') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="rule">Роль
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <select class="default-select form-control wide mb-3" name="rule_id"
                                                        id="rule">
                                                        @if (old('rule_id') == '')
                                                            <option value="0" selected disabled>{{ 'Права доступа..' }}
                                                            </option>
                                                            @foreach ($ruleList as $r)
                                                                <option value="{{ $r->id }}">{{ $r->name }}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($ruleList as $old)
                                                                @if (old('rule_id') == $old->id)
                                                                    <option value="{{ old('rule_id') }}" selected>
                                                                        {{ $old->name }}</option>
                                                                @else
                                                                    <option value="{{ $old->id }}">
                                                                        {{ $old->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="special">Специальность
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <select class="default-select form-control wide mb-3" name="special_id"
                                                        id="special">
                                                        @if (old('special_id') == '')
                                                            <option value="0" selected disabled>
                                                                {{ 'Специальность пользователя..' }}</option>
                                                            @foreach ($specList as $s)
                                                                <option value="{{ $s->id }}">{{ $s->name }}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($specList as $sold)
                                                                @if (old('special_id') == $sold->id)
                                                                    <option value="{{ old('special_id') }}" selected>
                                                                        {{ $sold->name }}</option>
                                                                @else
                                                                    <option value="{{ $sold->id }}">
                                                                        {{ $sold->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="parts">Разделы
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <select
                                                        class="multi-select-placeholder js-states select2-hidden-accessible"
                                                        name="parts[]" id="parts" multiple>
                                                        @foreach ($partList as $p)
                                                            <option value="{{ $p->id }}"
                                                                @if (old('parts')) @foreach (old('parts') as $po)
                                                   @if ($po == $p->id)
                                                      selected @endif
                                                                @endforeach
                                                        @endif
                                                        >{{ $p->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="oklad">Оклад
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text btn-primary">₽ / час</span>
                                                        <input type="number" class="input-group-text btn-primary"
                                                            id="rub-clock" value="{{ round(old('oklad') / 176, 2) }}">
                                                        <input type="number" class="form-control" id="oklad"
                                                            name="oklad" placeholder="Оклад пользователя.."
                                                            value="{{ old('oklad') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-lg btn-primary">Создать</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init.js') }}"></script>
    <script>
        $(function() {
            $('#oklad').bind('input', function() {
                var rub_clock = $(this).val();
                $("#rub-clock").val((rub_clock / 176).toFixed(2));
            });
            $('#rub-clock').bind('input', function() {
                var rub_clock = $(this).val();
                $("#oklad").val(rub_clock * 176);
            })
        });
    </script>
@endpush
