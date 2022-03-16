<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Author</th>
        <th scope="col">Date created</th>
        <th scope="col">Date updated</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->author }}</td>
            <td>{{ $post->created_at }}</td>
            <td>{{ $post->updated_at }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('post.edit', $post->id) }}"
                       class="btn btn-outline-dark" aria-label="{{ __('Edit') }}" title="{{ __('Edit') }}">
                        <i class="bi-pencil-square"></i>
                    </a>
                    <form method="POST"
                          action="{{ route('post.destroy', $post->id) }}"
                          onsubmit="return confirm('Do you really want to delete post?');">
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
    {{$posts->links()}}
</div>


