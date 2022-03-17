<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Author</th>
        <th scope="col">Content</th>
        <th scope="col">Post Id</th>
        <th scope="col">Date created</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($comments as $comment)
        <tr>
            <th scope="row">{{ $comment->id }}</th>
            <td>{{ $comment->author }}</td>
            <td>{{ $comment->content }}</td>
            <td>{{ $comment->post_id }}</td>
            <td>{{ $comment->created_at }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('comments.edit', $comment->id) }}"
                       class="btn btn-outline-dark" aria-label="{{ __('Edit') }}" title="{{ __('Edit') }}">
                        <i class="bi-pencil-square"></i>
                    </a>
                    <form method="POST"
                          action="{{ route('comments.destroy', $comment->id) }}"
                          onsubmit="return confirm('Do you really want to delete comment?');">
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
    {{$comments->links()}}
</div>


