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
{{--                <div class="mb-4">--}}
{{--                    <select class="form-select" id="tom-select" name="example-select2-multiple" style="width: 100%;" data-placeholder="Choose many.." multiple>--}}
{{--                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->--}}
{{--                        @foreach($permissions as $permission)--}}
{{--                            <option value="{{ $permission->id }}" @if ($role->hasPermissionTo($permission)) selected @endif>{{ $permission->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="p-4"><select id="select-state" name="state[]" multiple placeholder="Select a state..." autocomplete="off">
                        <option value="">Select a state...</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA" selected>California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY" selected>Wyoming</option>
                    </select></div>

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
@push('scripts')
    <script>
        new TomSelect("#select-state");
    </script>
@endpush
