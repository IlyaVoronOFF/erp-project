@extends('main')
@section('title') Редактирование клиента @stop
@section('content')
<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <!-- Button trigger modal -->
               <a type="button" class="btn btn-primary btn-rounded" href="{{route('pages.clients.index')}}">
                  <span class="btn-icon-start text-primary">
                  <i class="fas fa-arrow-left color-info"></i>
                  </span>Назад
               </a>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <form class="needs-validation" method="post" action="{{route('pages.clients.update',['client'=>$clientId])}}" novalidate>
                     @csrf
                     @method('put')
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
                                       placeholder="Название раздела.." value="{{$clientId->name}}" required>
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
                                       placeholder="Эл. почта.." value="{{$clientId->email}}" required>
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
                                       placeholder="Номер телефона.." value="{{$clientId->phone}}">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xl-12">
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="address">Адрес
                                 </label>
                                 <div class="col-lg-9">
                                    <textarea class="form-control" id="address" name="address"
                                       placeholder="Адрес клиента.." value="{{$clientId->address}}"></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xl-12">
                              <div class="mb-3 row">
                                 <label class="col-lg-3 col-form-label" for="description">Примечание
                                 </label>
                                 <div class="col-lg-9">
                                    <textarea class="form-control" id="description" name="description"
                                       placeholder="Уточнения по клиенту.." value="{{$clientId->description}}"></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-lg btn-primary">Сохранить</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection