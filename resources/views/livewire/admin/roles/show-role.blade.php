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
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-3">
                        <x-block class="block-bordered">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="{{ Str::slug($permission->name, '-') }}-checkbox"
                                   name="{{ Str::slug($permission->name, '-') }}-checkbox"
                                   @if ($role->hasPermissionTo($permission)) checked @endif>
                                <label class="form-check-label" for="{{ Str::slug($permission->name, '-') }}-checkbox">{{ $permission->name }}</label>
                            </div>
                        </x-block>
                    </div>
                @endforeach
            </div>
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
