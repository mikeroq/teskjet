@inject('markdown', 'Parsedown')
@php
    // TODO: There should be a better place for this.
    $markdown->setSafeMode(true);
    $markdown->setBreaksEnabled(true)
@endphp
<div class="block">
    <div class="block-header block-header-default">
        <a href="{{ route('users.profile', $comment->commenter->id) }}">
            <img src="{{ $comment->commenter->profile_photo_url }}" class="me-3 img-avatar" alt="Avatar for {{ $comment->commenter->name }}">
        </a>
            <h3 class="block-title lh-base">
                {{ $comment->commenter->name }}<br>
                <small>{{ $comment->commenter->email }}</small><br>
                <small class="text-light">
                    @if($comment->created_at->isCurrentDay())
                        <span title="{{ $comment->created_at->tz($comment->commenter->timezone)->format("M jS, Y g:ia") }}">{{ $comment->created_at->diffForHumans() }}</span>
                    @else
                        {{ $comment->created_at->tz($comment->commenter->timezone)->format("M jS, Y g:ia") }}
                    @endif
                </small>
            </h3>


        <div class="dropdown" id="comment-dropdown-{{ $comment->getKey() }}">
            <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog fa-fw mr-1"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right fs-sm">
                @can('edit comment', $comment)
                    <button data-bs-toggle="modal" data-bs-target="#comment-modal-{{ $comment->getKey() }}" class="dropdown-item">@lang('comments::comments.edit')</button>
                @endcan
                @can('delete comment', $comment)
                    <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();" class="dropdown-item">@lang('comments::comments.delete')</a>
                    <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                @endcan
            </div>
        </div>
    </div>
    <div class="block-content">

                    {!! $markdown->text($comment->comment) !!}
                    @can('edit comment', $comment)
                        <div class="modal right fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="block block-rounded block-transparent mb-0">
                                            <div class="block-header block-header-default">
                                                <h3 class="block-title">@lang('comments::comments.edit_comment')</h3>
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="block-content">
                                                <div class="mb-4">
                                                    <textarea required class="form-control form-control-alt" style="height: calc(100vh - 150px);" name="message">{{ $comment->comment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
                                                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">@lang('comments::comments.cancel')</button>
                                                <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">@lang('comments::comments.update')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endcan
                    <?php
                    if (!isset($indentationLevel)) {
                        $indentationLevel = 1;
                    } else {
                        $indentationLevel++;
                    }
                    ?>

                    {{-- Recursion for children --}}
                    @if($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel)
                        {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
                        @foreach($grouped_comments[$comment->getKey()] as $child)
                            @include('comments::_comment', [
                                'comment' => $child,
                                'grouped_comments' => $grouped_comments
                            ])
                        @endforeach
                    @endif

    </div>
</div>


{{-- Recursion for children --}}
@if($grouped_comments->has($comment->getKey()) && $indentationLevel > $maxIndentationLevel)
    {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
    @foreach($grouped_comments[$comment->getKey()] as $child)
        @include('comments::_comment', [
            'comment' => $child,
            'grouped_comments' => $grouped_comments
        ])
    @endforeach
@endif

