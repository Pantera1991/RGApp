<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Email</th>
        <th scope="col">Name</th>
        <th scope="col">Date created</th>
        <th scope="col">Date updated</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('users.edit', $user->id) }}"
                       class="btn btn-outline-dark" aria-label="{{ __('Edit') }}" title="{{ __('Edit') }}">
                        <i class="bi-pencil-square"></i>
                    </a>
                    <form method="POST"
                          action="{{ route('users.destroy', $user->id) }}"
                          onsubmit="return confirm('Do you really want to delete user?');">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit"
                                class="btn btn-outline-danger"
                                aria-label="{{ __('Delete') }}">
                            <i class="bi-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="pagination">
    {{$users->links()}}
</div>


