@extends('main')
@section('title') Создание объекта @stop
@section('content')
<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <!-- Button trigger modal -->
               <a type="button" class="btn btn-primary btn-rounded" href="{{route('pages.objects.index')}}">
                  <span class="btn-icon-start text-primary">
                  <i class="fas fa-arrow-left color-info"></i>
                  </span>Назад
               </a>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <form class="needs-validation" method="post" action="{{route('pages.objects.store')}}" novalidate>
                     @csrf
                     <div class="header-errors">
                        @include('inc.validateErrors')
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-xl-12">
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="title">Наименование
                                    <span class="text-danger">*</span>
                                 </label>
                                 <div class="col-lg-9">
                                    <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Название объекта.." value="{{old('title')}}" required>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="code">Шифр
                                    <span class="text-danger">*</span>
                                 </label>
                                 <div class="col-lg-9">
                                    <input type="text" class="form-control" id="code" name="code" placeholder="Шифр объекта.."
                                       value="{{old('code')}}" required>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="daterange">Дата начала и окончания
                                    <span class="text-danger">*</span>
                                 </label>
                                 <div class="col-lg-9">
                                    <input type="text" class="form-control input-daterange-datepicker" id="daterange"
                                       name="daterange" value="Укажите диапазон дат" value="{{old('daterange')}}" required>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="user">Руководитель проекта
                                    <span class="text-danger">*</span>
                                 </label>
                                 <div class="col-lg-9">
                                    <select class="default-select form-control wide mb-3" name="user_id" id="user">
                                          @if (old('user_id') == '')
                                             <option value="0" selected disabled>{{'Выберите пользователя..'}}</option>
                                             @foreach ($userList as $u)
                                                <option value="{{$u->id}}">{{$u->fio}}</option>
                                             @endforeach
                                          @else
                                             @foreach ($userList as $old)
                                                   @if (old('user_id') == $old->id)
                                                      <option value="{{old('user_id')}}" selected>{{$old->fio}}</option>
                                                   @else
                                                      <option value="{{$old->id}}">{{$old->fio}}</option>
                                                   @endif
                                             @endforeach
                                          @endif
                                    </select>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="stages">Стадии проекта
                                    <span class="text-danger">*</span>
                                 </label>
                                 <div class="col-lg-9">
                                    <select class="default-select form-control wide mb-3" name="stage_id" id="stages">
                                          @if (old('stage_id') == '')
                                             <option value="0" selected disabled>{{'Выберите стадию..'}}</option>
                                             @foreach ($stageList as $s)
                                                <option value="{{$s->id}}">{{$s->name}}</option>
                                             @endforeach
                                          @else
                                             @foreach ($stageList as $old)
                                                   @if (old('stage_id') == $old->id)
                                                      <option value="{{old('stage_id')}}" selected>{{$old->name}}</option>
                                                   @else
                                                      <option value="{{$old->id}}">{{$old->name}}</option>
                                                   @endif
                                             @endforeach
                                          @endif
                                    </select>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="project_sum">Стоимость проекта
                                    <span class="text-danger">*</span>
                                 </label>
                                 <div class="col-lg-9">
                                    <input type="number" class="form-control" id="project_sum" name="project_sum" placeholder="Общая стоимость в руб.."
                                       value="{{old('project_sum')}}" required>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="plan_fot">Планируемая ФОТ
                                    <span class="text-danger">*</span>
                                 </label>
                                 <div class="col-lg-9">
                                    <input type="number" class="form-control" id="plan_fot" name="plan_fot" placeholder="Примерная сумма в руб.."
                                       value="{{old('plan_fot')}}" required>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="addressObject">Адрес <span
                                       class="text-danger">*</span>
                                 </label>
                                 <div class="col-lg-9">
                                    <textarea class="form-control" id="addressObject" name="address" rows="5"
                                       placeholder="Адрес объекта.." required>{{old('address')}}</textarea>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="descriptionObject">Примечание</label>
                                 <div class="col-lg-9">
                                    <textarea class="form-control" id="descriptionObject" name="description" rows="5"
                                       placeholder="Комментарий к объекту..">{{old('description')}}</textarea>
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
<!-- pickdate -->
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/daterangepicker.js')}}"></script>
<!-- Pickdate init-->
<script src="{{asset('assets/js/bs-daterange-picker-init.js')}}"></script>
@endpush