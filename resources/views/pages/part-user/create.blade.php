<!-- Modal -->
<div class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавление записи</h5>
                <div id="displayDate" style="margin-left: 10px;"></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form class="needs-validation" method="post" action="{{ route('pages.part-user.store') }}" validate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-lg-3 col-form-label" for="hour">Часы
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" id="hour" name="time"
                                placeholder="Кол-во отработанных часов.." required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-3 col-form-label" for="description">Примечание</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Комментарий к записи.."></textarea>
                        </div>
                    </div>
                    <input id="date" name="date" value="" hidden>
                    <input name="object_parts_id" value="{{ $part_id }}" hidden>
                    <input name="object_parts_object_id" value="{{ $object_id }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/js/moment.js') }}"></script>
@endpush
