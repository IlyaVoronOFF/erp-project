@extends('main')
@section('title') Объект детально @stop
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class="card card-margin">
                            <div class="card-header border-0 pb-0">
                                <h2 class="card-title">{{ mb_strtoupper($objectId->title) }}</h2>
                            </div>
                            <div class="card-body pb-0">
                                <p style="padding-left: 1rem">{{ $objectId->description }}</p>
                                <div class="card-body-ul">
                                    <ul class="list-group list-group-flush col-3 border-end">
                                        <li class="list-group-item d-flex px-0 justify-content-start">
                                            <strong>Дата начала: </strong>
                                            <span class="mb-0">{{ substr($objectId->daterange, 0, 10) }}</span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-start">
                                            <strong>Дата окончания:</strong>
                                            <span class="mb-0">{{ substr($objectId->daterange, 13, 23) }}</span>
                                        </li>
                                    </ul>
                                    <ul class="list-group list-group-flush col-3 border-end">
                                        <li class="list-group-item d-flex px-0 justify-content-start">
                                            <strong>Шифр:</strong>
                                            <span class="mb-0">{{ $objectId->code }}</span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-start">
                                            <strong>Руководитель проекта:</strong>
                                            <span class="mb-0">{{ $objectId->user }}</span>
                                        </li>
                                    </ul>
                                    <ul class="list-group list-group-flush col-3 border-end">
                                        <li class="list-group-item d-flex px-0 justify-content-start">
                                            <strong>Стадия проекта:</strong>
                                            <span class="mb-0">{{ $objectId->stage }}</span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-start">
                                            <strong>Адрес объекта:</strong>
                                            <span class="mb-0">{{ $objectId->address }}</span>
                                        </li>
                                    </ul>
                                    <ul class="list-group list-group-flush col-3">
                                        <li class="list-group-item d-flex px-0 justify-content-between align-items-center">
                                            <strong>Проект выполнен на</strong>
                                            <div class="progress" style="background: rgba(127, 99, 244, .1);width:30%">
                                                <div @if ($progress > 100) class="progress-bar bg-danger"
                                                @elseif ($progress == 100) class="progress-bar bg-success"
                                                @else
                                                    class="progress-bar bg-primary" @endif
                                                    style="width: {{ $progress }}%;" role="progressbar">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div>
                                            <span
                                                @if ($progress > 100) class="badge badge-danger"
                                                @elseif ($progress == 100) class="badge badge-success"
                                                @else
                                                    class="badge badge-primary" @endif>{{ $progress }}
                                                %</span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-between align-items-center">
                                            <strong>Выплачено ФОТ</strong>
                                            <span class="badge badge-primary">0%</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @if (auth()->user()->rule_id < 5)
                                <div class="card-footer pt-0 pb-0 text-center">
                                    <div class="row">
                                        <div class="col-3 pt-3 pb-3 border-end">
                                            <h3 class="mb-1 text-primary">
                                                {{ number_format($objectId->project_sum, 0, '', ' ') }} ₽</h3>
                                            <span>Стоимость проекта</span>
                                        </div>
                                        <div class="col-3 pt-3 pb-3 border-end">
                                            <h3 class="mb-1 text-primary">
                                                {{ number_format($objectId->plan_fot, 0, '', ' ') }} ₽</h3>
                                            <span>Планируемая ФОТ</span>
                                        </div>
                                        <div class="col-3 pt-3 pb-3 border-end">
                                            @php
                                                $arr = [];
                                                foreach ($objPartsList as $i) {
                                                    $arr[] = $i->fot_part;
                                                }
                                            @endphp
                                            <h3
                                                class="mb-1 @if (array_sum($arr) <= $objectId->plan_fot) text-success
                                                @else
                                                text-danger @endif">
                                                {{ number_format(array_sum($arr), 0, '', ' ') }} ₽
                                            </h3>
                                            <span>Фактическая ФОТ</span>
                                        </div>
                                        <div class="col-3 pt-3 pb-3">
                                            <h3 class="mb-1 text-primary">
                                                {{ number_format(null, 0, '', ' ') }} ₽
                                            </h3>
                                            <span>Выплачено ФОТ</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                            @endif
                        </div>
                    </div>
                    <div id="btn-header" class="card-header">
                        <!-- Button trigger modal -->
                        <a type="button" class="btn btn-primary btn-rounded" href="{{ route('pages.objects.index') }}">
                            <span class="btn-icon-start text-primary">
                                <i class="fas fa-arrow-left color-info"></i>
                            </span>Назад
                        </a>
                        <div class="filters-table dataTables_wrapper"></div>
                        <!-- Button trigger modal -->
                        @if (auth()->user()->rule_id < 5)
                            <a type="button" class="btn btn-primary btn-rounded"
                                href="{{ route('pages.object-parts.create', ['object' => $objectId->id]) }}">
                                <span class="btn-icon-start text-primary">
                                    <i class="fa fa-plus color-info"></i>
                                </span>Добавить раздел
                            </a>
                        @else
                            <div></div>
                        @endif
                    </div>
                    <div class="card-body">
                        @include('inc.messages')
                        @include('pages.object-parts.deleteModal')
                        <div class="table-responsive">
                            <table id="example3" class="display table table-hover" style="min-width: 845px">
                                <thead>
                                    <tr class="table-primary">
                                        <th style="max-width: 40px">#</th>
                                        <th style="text-align: left;">Раздел</th>
                                        @if (auth()->user()->rule_id < 5)
                                            <th>Исполнитель</th>
                                        @endif
                                        <th>Начало</th>
                                        <th>Окончание</th>
                                        <th>Норма часов</th>
                                        @if (auth()->user()->rule_id < 5)
                                            <th>ФОТ раздела (руб)</th>
                                            <th style="max-width: 100px">Управление</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (auth()->user()->rule_id < 5)
                                        @forelse ($objPartsList as $i)
                                            <tr style="height:63.38px;">
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="text-align: left;">
                                                    <a href="{{ route('pages.part-user.index', ['object' => $objectId->id, 'part' => $i->id]) }}"
                                                        class="text-primary"><strong>{{ $i->part }}</strong></a>
                                                </td>
                                                <td>{{ $i->user }}</td>
                                                <td>{{ substr($i->daterange, 0, 10) }}</td>
                                                <td>{{ substr($i->daterange, 13, 23) }}</td>
                                                <td>{{ $i->time }}</td>
                                                <td>{{ number_format($i->fot_part, 0, '', ' ') }} ₽</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('pages.object-parts.edit', ['object_part' => $i->id]) }}"
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
                                    @else
                                        @forelse ($objPartsList as $i)
                                            @if (auth()->user()->id == $i->user_id)
                                                <tr style="height:63.38px;">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td style="text-align: left;">
                                                        <a href="{{ route('pages.part-user.index', ['object' => $objectId->id, 'part' => $i->id]) }}"
                                                            class="text-primary"><strong>{{ $i->part }}</strong></a>
                                                    </td>
                                                    <td>{{ substr($i->daterange, 0, 10) }}</td>
                                                    <td>{{ substr($i->daterange, 13, 23) }}</td>
                                                    <td>{{ $i->time }}</td>
                                                </tr>
                                            @endif
                                        @empty
                                        @endforelse
                                    @endif
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
        $('.filters-table').append($('#example3_length'), $('#example3_filter').attr('style', 'margin-left:80px;'));
    </script>
@endpush
