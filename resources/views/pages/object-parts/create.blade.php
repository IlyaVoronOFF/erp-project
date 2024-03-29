@extends('main')
@section('title') Добавление раздела @stop
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <a type="button" class="btn btn-primary btn-rounded"
                            href="{{ route('pages.object-parts.index', ['object' => $object_id]) }}">
                            <span class="btn-icon-start text-primary">
                                <i class="fas fa-arrow-left color-info"></i>
                            </span>Назад
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form class="needs-validation" method="post" action="{{ route('pages.object-parts.store') }}"
                                novalidate>
                                @csrf
                                <div class="header-errors">
                                    @include('inc.validateErrors')
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="parts">Раздел
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <select class="default-select form-control wide mb-3" name="part_id"
                                                        id="parts">
                                                        @if (old('part_id') == '')
                                                            <option value="0" selected disabled>
                                                                {{ 'Выберите раздел..' }}</option>
                                                            @foreach ($partList as $s)
                                                                <option value="{{ $s->id }}">{{ $s->name }}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($partList as $old)
                                                                @if (old('part_id') == $old->id)
                                                                    <option value="{{ old('part_id') }}" selected>
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
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="user">Исполнитель
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div id="usersSelect" class="col-lg-9">
                                                    <select class="default-select form-control wide mb-3" name="user_id"
                                                        id="user">
                                                        @if (old('user_id') == '')
                                                            <option value="0" selected disabled>
                                                                {{ 'Выберите пользователя..' }}</option>
                                                            @foreach ($userList as $u)
                                                                <option value="{{ $u->id }}">{{ $u->fio }}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($userList as $old)
                                                                @if (old('user_id') == $old->id)
                                                                    <option value="{{ old('user_id') }}" selected>
                                                                        {{ $old->fio }}</option>
                                                                @else
                                                                    <option value="{{ $old->id }}">
                                                                        {{ $old->fio }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="daterange">Дата начала и
                                                    окончания
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control input-daterange-datepicker"
                                                        id="daterange" name="daterange" value="Укажите диапазон дат"
                                                        value="{{ old('daterange') }}" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="time">Норма часов
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <input type="number" class="form-control" id="time" name="time"
                                                        placeholder="Кол-во рабочих часов на раздел.."
                                                        value="{{ old('time') }}" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="fot_part">ФОТ на раздел
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <input type="number" class="form-control" id="fot_part"
                                                        name="fot_part" placeholder="ФОТ в руб.."
                                                        value="{{ old('fot_part') }}" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label"
                                                    for="descriptionObject">Примечание</label>
                                                <div class="col-lg-9">
                                                    <textarea class="form-control" id="descriptionObject" name="description" rows="5"
                                                        placeholder="Комментарий к разделу..">{{ old('description') }}</textarea>
                                                </div>
                                            </div>
                                            <input name="object_id" value="{{ $object_id }}" hidden>
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
    <!-- pickdate -->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
    <!-- Pickdate init-->
    <script src="{{ asset('assets/js/bs-daterange-picker-init.js') }}"></script>
    <script>
        var usersParts = @json($usersParts);
        var value = $('#parts').val();
    </script>
    <script src="{{ asset('assets/js/bindSelectUsersByParts.js') }}"></script>
@endpush
