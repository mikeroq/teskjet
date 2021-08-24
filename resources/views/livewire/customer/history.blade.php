<div>
    <x-block>
        {{ $actions->fragment('history')->links() }}
        <table class="table table-striped table-hover">
            <thead>
            <th>Date</th>
            <th>Action</th>
            <td>Changes</td>
            <th>User</th>
            </thead>
            <tbody>
            @forelse($actions as $activity)
                <tr>
                    <td title="{{ tz($activity->created_at, true) }}">{{ tz($activity->created_at) }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>
                        @if($activity->description === "updated")
                            @foreach($activity->changes['attributes'] as  $key => $change)
                                {{ Str::of($key)->replace('_', ' ')->title() }} from {{ $change }} to {{ $activity->changes['old'][$key] }}<br>
                            @endforeach
                        @else

                        @endif

                    </td>
                    <td><a href="{{ route('users.profile', $activity->causer->id) }}">{{ $activity->causer->name }}</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No activity has been found</td>
                </tr>
            @endforelse

            </tbody>
        </table>
        {{ $actions->fragment('history')->links() }}
    </x-block>
</div>
