@if(config('services.facebook.active'))
    <a class="btn btn-sm btn-outline-info m-1 mt-4" href="{{ route('social.login', 'facebook')  }}">
        <i class="fab fa-facebook-f"></i>
    </a>
@endif

@if(config('services.google.active'))
    <a class="btn btn-sm btn-outline-info m-1 mt-4" href="{{ route('social.login', 'google')  }}">
        <i class="fab fa-google"></i>
    </a>
@endif

@if(config('services.github.active'))
    <a class="btn btn-sm btn-outline-info m-1 mt-4" href="{{ route('social.login', 'github')  }}">
        <i class="fab fa-github"></i>
    </a>
@endif

@if(config('services.bitbucket.active'))
    <a class="btn btn-sm btn-outline-info m-1 mt-4" href="{{ route('social.login', 'bitbucket')  }}">
        <i class="fab fa-bitbucket"></i>
    </a>
@endif

@if(config('services.linkedin.active'))
    <a class="btn btn-sm btn-outline-info m-1 mt-4" href="{{ route('social.login', 'linkedin')  }}">
        <i class="fab fa-linkedin-in"></i>
    </a>
@endif

@if(config('services.twitter.active'))
    <a class="btn btn-sm btn-outline-info m-1 mt-4" href="{{ route('social.login', 'twitter')  }}">
        <i class="fab fa-twitter"></i>
    </a>
@endif
