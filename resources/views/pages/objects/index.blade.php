@extends('main')
@section('title') Объекты @stop
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div id="btn-header" class="card-header">
                        <!-- Button trigger modal -->
                        @if (auth()->user()->rule_id < 5)
                            <a type="button" class="btn btn-primary btn-rounded" href="{{ route('pages.objects.create') }}">
                                <span class="btn-icon-start text-primary">
                                    <i class="fa fa-plus color-info"></i>
                                </span>Создать объект
                            </a>
                        @else
                            <div></div>
                        @endif
                        <div class="filters-table dataTables_wrapper filters-just">
                            <div class="filter-year">
                                <form action="" method="get" id="filter-form">
                                    <label>Статусы:</label>
                                    <div style="width:600px;">
                                        <select class="multi-select-placeholder js-states select2-hidden-accessible"
                                            name="status_id[]" id="filter-status" multiple>
                                            <option value="">Все</option>
                                            @foreach ($setStatuses as $p)
                                                <option name="status_id" style="background-color: {{ $p->color }}"
                                                    value="{{ $p->id }}"
                                                    @if (isset($_GET['status_id'])) @foreach ($_GET['status_id'] as $po)
                                                   @if ($po == $p->id)
                                                      selected @endif
                                                    @endforeach
                                            @endif
                                            >{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="btn-group btn-rounded me-2" style="margin-left: -100px;">
                                            <button type="submit" class="btn btn-primary btn-sm sharp" alt="Применить"><i
                                                    class="fas fa-check"></i></button>
                                            <button id="select-del" type="button" class="btn btn-danger btn-sm sharp"
                                                alt="Очистить"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('inc.messages')
                        @include('pages.objects.deleteModal')
                        <div class="table-responsive">
                            <table id="example3"
                                class="display table table-bordered table-striped verticle-middle table-responsive-sm table-hover"
                                style="min-width: 845px">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>#</th>
                                        <th style="min-width: 100px">Шифр</th>
                                        <th style="min-width: 300px;text-align: left;">Наименование</th>
                                        <th>Статус</th>
                                        <th>Дата начала</th>
                                        <th>Дата окончания</th>
                                        <th>Стадии</th>
                                        @if (auth()->user()->rule_id < 5)
                                            <th>Стоимость проекта</th>
                                            <th>Планируемая ФОТ (руб)</th>
                                        @endif
                                        {{-- <th>Выплач. ФОТ (руб)</th>
                                        <th>Выплач. ФОТ (%)</th> --}}
                                        <th>Выполнено (%)</th>
                                        @if (auth()->user()->rule_id < 5)
                                            <th>Управление</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (auth()->user()->rule_id < 3)
                                        @forelse ($objectsList as $i)
                                            <tr style="height:63.38px;">
                                                <td>{{ $i->id }}</td>
                                                <td>{{ $i->code }}</td>
                                                <td style="text-align: left;">
                                                    <a href="{{ route('pages.object-parts.index', ['object' => $i->id]) }}"
                                                        class="text-primary"><strong>{{ $i->title }}</strong></a>
                                                </td>
                                                <td style="min-width: 111px;">
                                                    @foreach ($setStatuses as $s)
                                                        @if ($i->archive == $s->id)
                                                            <div class="status-btn"
                                                                style="background-color:{{ $s->color }}!important">
                                                                {{ $s->name }}</div>
                                                        @elseif($i->archive == 0)
                                                            {{ '-' }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ substr($i->daterange, 0, 10) }}</td>
                                                <td>{{ substr($i->daterange, 13, 23) }}</td>
                                                <td>{{ $i->stage_name }}</td>
                                                <td><strong>{{ number_format($i->project_sum, 0, '', ' ') }} ₽</strong>
                                                </td>
                                                <td><strong>{{ number_format($i->plan_fot, 0, '', ' ') }} ₽</strong>
                                                </td>
                                                {{-- <td></td>
                                            <td><span class="badge badge-primary light">70%</span></td> --}}
                                                <td>
                                                    @php
                                                        $tobj = $timeParts
                                                            ->where('object_id', $i->id)
                                                            ->map(function ($e) {
                                                                return $e->sum_times;
                                                            })
                                                            ->first();
                                                        $tevent = $setEvents
                                                            ->where('object_id', $i->id)
                                                            ->map(function ($e) {
                                                                return $e['total_time'];
                                                            })
                                                            ->first();
                                                        if ($tobj && $tevent) {
                                                            $progress = round(100 / ($tobj / $tevent));
                                                        } else {
                                                            $progress = 0;
                                                        }
                                                    @endphp
                                                    <span
                                                        @if ($progress > 100) class="badge badge-danger"
                                                @else
                                                    class="badge badge-primary" @endif>
                                                        {{ $progress }} %
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('pages.objects.edit', ['object' => $i->id]) }}"
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
                                    @elseif(auth()->user()->rule_id == 3 || auth()->user()->rule_id == 4)
                                        @forelse ($objectsList as $i)
                                            @if (auth()->user()->id == $i->user_id)
                                                <tr style="height:63.38px;">
                                                    <td>{{ $i->id }}</td>
                                                    <td>{{ $i->code }}</td>
                                                    <td style="text-align: left;">
                                                        <a href="{{ route('pages.object-parts.index', ['object' => $i->id]) }}"
                                                            class="text-primary"><strong>{{ $i->title }}</strong></a>
                                                    </td>
                                                    <td>
                                                        @foreach ($setStatuses as $s)
                                                            @if ($i->archive == $s->id)
                                                                <div class="status-btn"
                                                                    style="background-color:{{ $s->color }}!important">
                                                                    {{ $s->name }}</div>
                                                            @elseif($i->archive == 0)
                                                                {{ '-' }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ substr($i->daterange, 0, 10) }}</td>
                                                    <td>{{ substr($i->daterange, 13, 23) }}</td>
                                                    <td>{{ $i->stage_name }}</td>
                                                    <td><strong>{{ number_format($i->project_sum, 0, '', ' ') }}
                                                            ₽</strong>
                                                    </td>
                                                    <td><strong>{{ number_format($i->plan_fot, 0, '', ' ') }}
                                                            ₽</strong>
                                                    </td>
                                                    {{-- <td></td>
                                            <td><span class="badge badge-primary light">70%</span></td> --}}
                                                    <td>
                                                        @php
                                                            $tobj = $timeParts
                                                                ->where('object_id', $i->id)
                                                                ->map(function ($e) {
                                                                    return $e->sum_times;
                                                                })
                                                                ->first();
                                                            $tevent = $setEvents
                                                                ->where('object_id', $i->id)
                                                                ->map(function ($e) {
                                                                    return $e['total_time'];
                                                                })
                                                                ->first();
                                                            if ($tobj && $tevent) {
                                                                $progress = round(100 / ($tobj / $tevent));
                                                            } else {
                                                                $progress = 0;
                                                            }
                                                        @endphp
                                                        <span
                                                            @if ($progress > 100) class="badge badge-danger"
                                                @else
                                                    class="badge badge-primary" @endif>
                                                            {{ $progress }} %
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('pages.objects.edit', ['object' => $i->id]) }}"
                                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                    class="fa fa-pencil-alt"></i></a>
                                                            <a href="#exampleModalCenter"
                                                                class="btn btn-danger shadow btn-xs sharp delete"
                                                                rel="{{ $i->id }}" data-bs-toggle="modal"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                        @endforelse
                                    @elseif(auth()->user()->rule_id == 5)
                                        @foreach ($partsUser as $o)
                                            @forelse ($objectsList as $i)
                                                @if ($o->object_id == $i->id)
                                                    <tr style="height:63.38px;">
                                                        <td>{{ $i->id }}</td>
                                                        <td>{{ $i->code }}</td>
                                                        <td style="text-align: left;">
                                                            <a href="{{ route('pages.object-parts.index', ['object' => $i->id]) }}"
                                                                class="text-primary"><strong>{{ $i->title }}</strong></a>
                                                        </td>
                                                        <td>
                                                            @foreach ($setStatuses as $s)
                                                                @if ($i->archive == $s->id)
                                                                    <div class="status-btn"
                                                                        style="background-color:{{ $s->color }}!important">
                                                                        {{ $s->name }}</div>
                                                                @elseif($i->archive == 0)
                                                                    {{ '-' }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{{ substr($i->daterange, 0, 10) }}</td>
                                                        <td>{{ substr($i->daterange, 13, 23) }}</td>
                                                        <td>{{ $i->stage_name }}</td>
                                                        {{-- <td></td>
                                            <td><span class="badge badge-primary light">70%</span></td> --}}
                                                        <td>
                                                            @php
                                                                $tobj = $timeParts
                                                                    ->where('object_id', $i->id)
                                                                    ->map(function ($e) {
                                                                        return $e->sum_times;
                                                                    })
                                                                    ->first();
                                                                $tevent = $setEvents
                                                                    ->where('object_id', $i->id)
                                                                    ->map(function ($e) {
                                                                        return $e['total_time'];
                                                                    })
                                                                    ->first();
                                                                if ($tobj && $tevent) {
                                                                    $progress = round(100 / ($tobj / $tevent));
                                                                } else {
                                                                    $progress = 0;
                                                                }
                                                            @endphp
                                                            <span
                                                                @if ($progress > 100) class="badge badge-danger"
                                                @else
                                                    class="badge badge-primary" @endif>
                                                                {{ $progress }} %
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                        @endforeach
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
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2-init.js') }}"></script>
    <script>
        $(function() {
            $("#successMsg").delay(5000).slideUp(300);
            $("#errorMsg").delay(5000).slideUp(300);
        });
    </script>
    <script>
        $('.filters-table').append($('#example3_length'), $('#example3_filter'));
    </script>
    <script>
        $('#select-del').click(function() {
            location.href = '/objects';
        })
    </script>
@endpush
