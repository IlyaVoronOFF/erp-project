@extends('main')
@section('title') Раздел детально @stop
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @include('inc.messages')
                        @include('pages.part-user.create')
                        @include('pages.part-user.delete')
                        <div class="row">
                            <div class="col-xl-3 col-xxl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Button trigger modal -->
                                        <a type="button" class="btn btn-primary btn-rounded" style="margin-bottom: 25px"
                                            href="{{ route('pages.object-parts.index', ['object' => $object_id]) }}">
                                            <span class="btn-icon-start text-primary">
                                                <i class="fas fa-arrow-left color-info"></i>
                                            </span>Назад
                                        </a>
                                        @forelse ($objPartsList as $i)
                                            <p>Объект:
                                            <h3 class="card-intro-title">
                                                {{ $i->object }}
                                            </h3>
                                            </p>
                                            <p>Раздел:
                                            <h5 class="card-intro-title">{{ $i->part }}</h5>
                                            </p>
                                            <p>Руководитель проекта:
                                            <h5 class="card-intro-title">{{ $user_object->user }}</h5>
                                            </p>
                                            <p>Исполнитель:
                                            <h5 class="card-intro-title">{{ $i->user }}</h5>
                                            </p>
                                            <p>Всего отработано часов:
                                            <h5 class="card-intro-title"><span
                                                    @if ($count > $i->time) class="badge badge-lg badge-danger"
                                                    @else
                                                        class="badge badge-lg badge-success" @endif>{{ $count }}</span>{{ ' из ' }}<span
                                                    class="badge badge-lg badge-primary">{{ $i->time }}</span>
                                            </h5>
                                            </p>
                                            <div class="">
                                                <div id="external-events" class="my-3">
                                                    @if ($i->description)
                                                        <p>Примечание к разделу:<br>{{ '"' . $i->description . '"' }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-xxl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="calendar"
                                            class="app-fullcalendar fc fc-media-screen fc-direction-ltr fc-theme-standard">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->rule_id < 5)
                    <div class="card">
                        <div class="card-header" style="align-items: end;">
                            <h4 class="card-intro-title ">Статистика отработанных часов за выбранный год по месяцам</h4>
                            <div class="filter-year">
                                <label>Год:</label>
                                <select class="default-select form-control-filter-year wide" name="filter-year"
                                    id="filter-year">
                                    <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                    <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                    <option value="{{ date('Y') - 2 }}">{{ date('Y') - 2 }}</option>
                                    <option value="{{ date('Y') - 3 }}">{{ date('Y') - 3 }}</option>
                                    <option value="{{ date('Y') - 4 }}">{{ date('Y') - 4 }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="myChart" style="display: block; width: 673px; height: 336px;" width="673"
                                height="200" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endsection
    @push('js')
        <!-- calendar -->
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script>
            var events = @json($events);
            var dataEvents = @json($dataEvents);
        </script>
        <script>
            $(function() {
                var valYear = $('#filter-year').val();
                dataEvents.forEach(e => {
                    //console.log(e.date.substr(0, 4) == new Date().getFullYear())
                    if (e.date.substr(0, 4) == valYear) {
                        let t = e.date.substr(5, 2);
                        myChart.data.datasets[0].data[t - 1] += parseInt(e.time);
                    }
                });
                myChart.update();
                $('#filter-year').change(function() {
                    myChart.data.datasets[0].data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                    var valYear = $(this).val();
                    dataEvents.forEach(e => {
                        if (e.date.substr(0, 4) == valYear) {
                            let t = e.date.substr(5, 2);
                            myChart.data.datasets[0].data[t - 1] += parseInt(e.time);
                        }
                    });
                    //console.log(valYear)
                    //console.log(myChart.data.datasets[0].data)
                    myChart.update();
                })
            });
        </script>
        <script src="{{ asset('assets/js/main.min.js') }}"></script>
        <script src="{{ asset('assets/js/fullcalendar-init.js') }}"></script>
        <script src="{{ asset('assets/js/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/myBarChartjs-init.js') }}"></script>
        <script>
            $(function() {
                if ({{ auth()->user()->rule_id }} == 5) {
                    setTimeout(function() {
                        $('.fc-event-del').hide();
                    }, 100);
                }
            })
        </script>
        <script>
            $(function() {
                $("#successMsg").delay(5000).slideUp(300);
                $("#errorMsg").delay(5000).slideUp(300);
            });
        </script>
    @endpush
