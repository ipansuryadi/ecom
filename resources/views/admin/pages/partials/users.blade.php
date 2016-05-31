
<h6>There are {{$count}} users</h6>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center blue white-text col-md-1">Delete</th>
            <th class="text-center blue white-text">Username</th>
            <th class="text-center blue white-text">Joined</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td class="text-center">
                <form method="post" action="{{ route('admin.delete', $user->id) }}" class="delete_form_user">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button id="delete-user-btn">
                        <i class="fa fa-trash red-text" aria-hidden="true"></i>
                    </button>
                </form>
            </td>
            <td>
                {{ $user->username }}
            </td>
            <td>
                {{ prettyDate($user->created_at) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>