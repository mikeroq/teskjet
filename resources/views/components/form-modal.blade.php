<div class="modal right fade" id="{{ $slug }}_{{ $type }}_modal" tabindex="-1" role="dialog" aria-labelledby="{{ $slug }}_{{ $type }}_modal" aria-hidden="true">
    <form action="" method="POST" id="{{ $slug }}_{{ $type }}_form">
        @csrf
        @if($type == "edit")
        @method('PATCH')
        @endif
        <div class="modal-dialog" role="document">
            <div class="modal-content block block-themed">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title"><i class="{{ $icon }} me-1"></i> {{ $title }}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div id="{{ $slug }}_{{ $type }}_body" class="modal-body bg-dark text-gray">
                    {{ $slot }}
                </div>
                <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
                    <button type="submit" class="btn btn-primary" id="{{ $slug }}_{{ $type }}_btn">
                        <i class="{{ $icon }} fa-fw me-1"></i>
                        <span>{{ $btn }}</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
