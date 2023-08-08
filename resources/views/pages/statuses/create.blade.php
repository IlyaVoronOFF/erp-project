@extends('main')
@section('title') Создание статуса @stop
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <a type="button" class="btn btn-primary btn-rounded" href="{{ route('pages.statuses.index') }}">
                            <span class="btn-icon-start text-primary">
                                <i class="fas fa-arrow-left color-info"></i>
                            </span>Назад
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form class="needs-validation" method="post" action="{{ route('pages.statuses.store') }}"
                                novalidate>
                                @csrf
                                <div class="header-errors">
                                    @include('inc.validateErrors')
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="name">Наименование
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Название статуса.." value="{{ old('name') }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                <label class="col-lg-3 col-form-label" for="color">Цвет
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <input type="text" class="as_colorpicker form-control" id="color"
                                                        name="color" placeholder="#000000" value="{{ old('color') }}"
                                                        required>
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
    <!-- colorPicker -->
    <script src="{{ asset('assets/js/jquery-asColor.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-asGradient.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-asColorPicker.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery-asColorPicker.init.js') }}"></script>
@endpush
