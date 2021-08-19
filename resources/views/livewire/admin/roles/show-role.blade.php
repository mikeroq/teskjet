<div>
    <x-page-header :title="$role->name" subtitle="Viewing Role">
        <x-action-dropdown id="role_action_dropdown">
            <button class="dropdown-item" wire:click=''>
                <i class="fas fa-edit me-1 fa-fw"></i>
                Edit Role
            </button>
            <button class="dropdown-item" wire:click=''>
                <i class="fas fa-location-arrow me-1 fa-fw"></i>
                Add Permission
            </button>
            <button class="dropdown-item">
                <i class="fas fa-times me-1 fa-fw"></i>
                Delete Role
            </button>
        </x-action-dropdown>
    </x-page-header>
    <div class="content">
        <x-block title="Permissions">
            <x-form-group label="Permissions">
                <select id="select-tags" multiple placeholder="" hidden>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->name }}" @if ($role->hasPermissionTo($permission)) selected @endif>{{ $permission->name }}</option>
                    @endforeach
                </select>
            </x-form-group>
        </x-block>
        <x-block title="Users">
            <p>
                @forelse($role->users as $user)
                    {{ $user->name }} ({{ $user->email }})<br >
                @empty
                    No users have this role
                @endforelse
            </p>
        </x-block>
    </div>
</div>
@push('scripts')
    <script>

        new TomSelect("#select-tags",{
            plugins: ['remove_button', 'no_backspace_delete', 'no_active_items'],
            onItemAdd:function(){
                this.setTextboxValue('');
                this.refreshOptions();
            },
            render:{
                option:function(data,escape){
                    return '<div class="d-flex"><span>' + escape(data.value) + '</span></div>';
                },
                item:function(data,escape){
                    return '<div>' + escape(data.value) + '</div>';
                }
            }
        });
    </script>
@endpush
