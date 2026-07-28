<div class="modal fade" id="exampleModal{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Add image inside the body of modal -->
            <div class="modal-body">
                <img id="image" src="{{ $image }}"width="100%" />
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" href="{{ $image }}" download>@lang('main.download')</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    @lang('main.close')
                </button>
            </div>
        </div>
    </div>
</div>
