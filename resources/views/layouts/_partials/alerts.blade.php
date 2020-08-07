@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <div class="alert-text">
                <strong>Oops! </strong>
            </div>
            {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success">
        <div class="alert-text">
            <strong>Done! </strong>
            {{ session('success') }}
        </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-warning">
        <div class="alert-text">
            <strong>Warning! </strong>
            {{ session('error') }}
        </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif