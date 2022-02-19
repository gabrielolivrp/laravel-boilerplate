@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ __('Whoops! Something went wrong.') }}
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session()->get('flash_danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('flash_danger') }}
    </div>
@endif

@if(session()->get('flash_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('flash_success') }}
    </div>
@endif
