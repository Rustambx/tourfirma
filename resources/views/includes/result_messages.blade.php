@if($errors->count() > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif