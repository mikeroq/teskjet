<div class="block block-rounded block-themed ajax-reload" id="{{ $type->slug }}_block" wire:loading.class="block-mode-loading block-mode-loading-refresh">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ $type->name }} Navigation</h3>
        <div class="block-options">
            <button class="btn-block-option" wire:click="$refresh" title="Refresh link table">
                <i class="fas fa-sync-alt mr-1"></i>
            </button>
            <button class="btn-block-option add_nav_modal" wire:click="$emit('openModal', 'admin.modals.add-navigation', {{ json_encode(['type' => $type->id, 'parent' => '0'], JSON_THROW_ON_ERROR) }})" title="Create a new link">
                <i class="fas fa-plus mr-1"></i>
                <span>Add Link</span>
            </button>
        </div>
    </div>
    <div class="block-content p-0">
        <div class="table-responsive">
            <table class="table table-vcenter mb-0">
                <thead>
                <tr>
                    <th>Link Name</th>
                    <th>URL Slug</th>
                    <th>User Level</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                @forelse($parent_pages as $parent)
                    <tr class="table-active">
                        <td>
                            <i class="{{$parent->icon}} fa-fw mr-1"></i>
                            {{$parent->title}}
                        </td>
                        <td>/{{$parent->url}}</td>
                        <td>{{$parent->level}}</td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <button onclick="this.blur()" class="btn btn-sm btn-secondary" wire:click="$emit('openModal', 'admin.modals.add-navigation', {{ json_encode(['type' => $type->id, 'parent' => $parent->id], JSON_THROW_ON_ERROR) }})" title="Add child link"><i class="fas fa-plus fa-fw"></i></button>
                                <button onclick="this.blur()" class="btn btn-sm btn-secondary" wire:click="triggerNavigationDelete({{ $parent->id }})" title="Delete link"><i class="far fa-trash-alt fa-fw"></i></button>
                                <button onclick="this.blur()" class="btn btn-sm btn-secondary" wire:click="$emit('openModal', 'admin.modals.edit-navigation-modal', {{ json_encode(['type' => 'parent', 'id' => $parent->id], JSON_THROW_ON_ERROR) }})" title="Edit link"><i class="fas fa-pencil-alt fa-fw"></i></button>
                                <button onclick="this.blur()" class="btn btn-sm btn-secondary" wire:click="orderParent({{ $parent->id }}, 'up')" @if($loop->first) disabled @endif title="Move link up"><i class="fas fa-angle-up fa-fw"></i></button>
                                <button onclick="this.blur()" class="btn btn-sm btn-secondary" wire:click="orderParent({{ $parent->id }}, 'down')" @if($loop->last) disabled @endif title="Move link down"><i class="fas fa-angle-down fa-fw"></i></button>
                            </div>
                        </td>
                    </tr>
                    @foreach($parent->children()->orderBy('order_column', 'ASC')->get() as $child)
                        <tr data-mtype="child">
                            <td>
                                <i class="fa fa-blank fa-fw mr-1"></i>
                                <i class="fas fa-level-up-alt fa-rotate-90 fa-fw mr-1"></i>

                                {{$child->title}}
                            </td>
                            <td>/{{$child->url}}</td>
                            <td>{{$child->level}}</td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <button onclick="this.blur()" class="btn btn-sm btn-secondary delete" wire:click="triggerNavigationChildDelete({{ $child->id }})" title="Delete link"><i class="far fa-trash-alt fa-fw"></i></button>
                                    <button onclick="this.blur()" class="btn btn-sm btn-secondary edit" wire:click="$emit('openModal', 'admin.modals.add-navigation', {{ json_encode(['type' => 'child', 'id' => $child->id], JSON_THROW_ON_ERROR) }})" title="Edit link"><i class="fas fa-pencil-alt fa-fw"></i></button>
                                    <button onclick="this.blur()" class="btn btn-sm btn-secondary sortable" wire:click="orderChild({{ $child->id }}, 'up')" @if($loop->first) disabled @endif title="Move link up"><i class="fas fa-angle-up fa-fw"></i></button>
                                    <button onclick="this.blur()" class="btn btn-sm btn-secondary sortable" wire:click="orderChild({{ $child->id }}, 'down')" @if($loop->last) disabled @endif title="Move link down"><i class="fas fa-angle-down fa-fw"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tbody>
                    <tr>
                        <td colspan='8'>No pages found</td>
                    </tr>
                    </tbody>
                @endforelse
            </table>
        </div>
    </div>
</div>

