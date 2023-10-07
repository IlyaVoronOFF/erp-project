@extends('main')
@section('title') Пользователи @stop
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div id="btn-header" class="card-header">
                        <!-- Button trigger modal -->
                        <a type="button" class="btn btn-primary btn-rounded" href="{{ route('pages.users.create') }}">
                            <span class="btn-icon-start text-primary">
                                <i class="fa fa-plus color-info"></i>
                            </span>Создать пользователя
                        </a>
                        <div class="filters-table dataTables_wrapper filters-just"></div>
                    </div>
                    <div class="card-body">
                        @include('inc.messages')
                        @include('pages.users.deleteModal')
                        <div class="table-responsive">
                            <table id="example3" class="display table table-hover" style="min-width: 845px">
                                <thead>
                                    <tr class="table-primary">
                                        <th style="max-width: 40px">#</th>
                                        <th style="text-align: left;">ФИО</th>
                                        <th>Почта</th>
                                        <th>Телефон</th>
                                        <th>Пароль</th>
                                        <th>Специальность</th>
                                        <th>Разделы</th>
                                        <th>Оклад</th>
                                        <th>Роль</th>
                                        <th style="max-width: 100px">Управление</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($usersList as $i)
                                        <tr style="height:63.38px;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="text-align: left;">{{ $i->fio }}</td>
                                            <td>{{ $i->email }}</td>
                                            <td>{{ $i->phone }}</td>
                                            <td>{{ $i->num_pass }}</td>
                                            <td>{{ $i->speciality_name }}</td>
                                            <td>
                                                @forelse ($partsList as $p)
                                                    @if ($i->id == $p->user_id)
                                                        {{ $p->partShort_name . '-' }}
                                                    @endif
                                                @empty
                                                @endforelse
                                            </td>
                                            <td>{{ number_format($i->oklad, 0, '', ' ') }}</td>
                                            <td>{{ $i->rule_name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('pages.users.edit', ['user' => $i->id]) }}"
                                                        class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                            class="fa fa-pencil-alt"></i></a>
                                                    <a href="#exampleModalCenter"
                                                        class="btn btn-danger shadow btn-xs sharp delete"
                                                        rel="{{ $i->id }}" data-bs-toggle="modal"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- dataTable -->
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.init.js') }}"></script>
    <script>
        $(function() {
            $("#successMsg").delay(5000).slideUp(300);
            $("#errorMsg").delay(5000).slideUp(300);
        });
    </script>
    <script>
        $('.filters-table').append($('#example3_length'), $('#example3_filter'));
    </script>
@endpush
