<div class="row">
    <div class="col-12">
        @if (session('message.success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message.success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('message.error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('message.error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
