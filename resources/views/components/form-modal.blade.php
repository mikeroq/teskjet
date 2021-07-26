<div class="modal right fade" id="{{ $slug }}_modal" tabindex="-1" role="dialog" aria-labelledby="{{ $slug }}_modal" aria-hidden="true">
    <form action="" method="POST" id="{{ $slug }}_form">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content block block-themed">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title"><i class="{{ $icon }} mr-1"></i> {{ $title }}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div id="{{ $slug }}_body" class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer modal-footer-fixed">
                    <button type="submit" class="btn btn-primary" id="{{ $slug }}_btn">
                        <i class="{{ $icon }} fa-fw mr-1"></i>
                        <span>{{ $btn }}</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
