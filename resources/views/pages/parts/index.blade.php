@extends('main')
@section('title') Разделы @stop
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div id="btn-header" class="card-header">
                        <!-- Button trigger modal -->
                        <a type="button" class="btn btn-primary btn-rounded" href="{{ route('pages.parts.create') }}">
                            <span class="btn-icon-start text-primary">
                                <i class="fa fa-plus color-info"></i>
                            </span>Создать раздел
                        </a>
                        <div class="filters-table dataTables_wrapper filters-just"></div>
                    </div>
                    <div class="card-body">
                        @include('inc.messages')
                        @include('pages.parts.deleteModal')
                        <div class="table-responsive">
                            <table id="example3" class="display table table-hover" style="min-width: 845px">
                                <thead>
                                    <tr class="table-primary">
                                        <th style="max-width: 40px">#</th>
                                        <th style="text-align: left;">Наименование</th>
                                        <th>Аббревеатура</th>
                                        <th style="max-width: 100px">Управление</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($partsList as $i)
                                        <tr style="height:63.38px;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="text-align: left;">{{ $i->name }}</td>
                                            <td>{{ $i->short_name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('pages.parts.edit', ['part' => $i->id]) }}"
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
