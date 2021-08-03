<table class="table table-vcenter table-hover table-dark mb-0">
    <thead>
        <tr>
            <th>Navigation</th>
            <th>Slug</th>
            <th>User Level</th>
            <th style="text-align: right;">Actions</th>
        </tr>
    </thead>

    @forelse($parent_pages as $page)
    <tbody>
        <tr data-mtype="parent">
            <td>
                <i class="{{$page->icon}} fa-fw mr-1"></i>
                {{$page->title}}
            </td>
            <td>{{$page->url}}</td>
            <td>{{$page->level}}</td>
            <td align="right">
                <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-success add-child" data-navtype="{{ $page->navigation_type_id }}" data-id="{{$page->id}}"><i class="fas fa-plus fa-fw"></i></button>
                    <button class="btn btn-sm btn-danger delete" data-delete="{{$page->id}}" data-type="parent" data-name="{{$page->title}}"><i class="far fa-trash-alt fa-fw"></i></button>
                    <button class="btn btn-sm btn-grape edit" data-id="{{$page->id}}"><i class="fas fa-pencil-alt fa-fw"></i></button>
                    <button class="btn btn-sm btn-primary sortable" data-type="parent" data-direction="up" data-id="{{$page->id}}" @if($loop->first) disabled @endif><i class="fas fa-angle-up fa-fw"></i></button>
                    <button class="btn btn-sm btn-primary sortable" data-type="parent" data-direction="down" data-id="{{$page->id}}" @if($loop->last) disabled @endif><i class="fas fa-angle-down fa-fw"></i></button>
                </div>
            </td>
        </tr>
        @foreach($page->children()->orderBy('order_column', 'ASC')->get() as $child)
        <tr data-mtype="child">
            <td>
                <i class="fa fa-blank fa-fw mr-1"></i>
                <i class="fas fa-level-up-alt fa-rotate-90 fa-fw mr-1"></i>

                {{$child->title}}
            </td>
            <td>{{$child->url}}</td>
            <td>{{$child->level}}</td>
            <td align="right">
                <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-danger delete" data-type="child" data-delete="{{$child->id}}" data-name="{{$child->title}}"><i class="far fa-trash-alt fa-fw"></i></button>
                    <button class="btn btn-sm btn-grape edit" data-type="child" data-id="{{$child->id}}"><i class="fas fa-pencil-alt fa-fw"></i></button>
                    <button class="btn btn-sm btn-primary sortable" data-direction="up" data-type="child" data-id="{{$child->id}}" @if($loop->first) disabled @endif><i class="fas fa-angle-up fa-fw"></i></button>
                    <button class="btn btn-sm btn-primary sortable" data-direction="down" data-type="child" data-id="{{$child->id}}" @if($loop->last) disabled @endif><i class="fas fa-angle-down fa-fw"></i></button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    @empty
    <tbody>
        <tr>
            <td colspan='8'>No pages found</td>
        </tr>
    </tbody>
    @endforelse
</table>
