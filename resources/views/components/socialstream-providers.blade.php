    @if (JoelButcher\Socialstream\Socialstream::hasFacebookSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::facebook()]) }}" class="btn btn-block btn-hero-primary bg-default">
            <i class="fa fab fa-facebook mr-1"></i> Sign in with Facebook
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasGoogleSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::google()]) }}" class="btn btn-block btn-hero-primary bg-xplay-light">
            <i class="fa fab fa-google mr-1"></i> Sign in with Google
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasTwitterSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::twitter()]) }}" class="btn btn-block btn-hero-primary bg-xplay-light">
            <i class="fa fab fa-twitter mr-1"></i> Sign in with Twitter
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasLinkedInSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::linkedin()]) }}" class="btn btn-block btn-hero-primary bg-xpro">
            <i class="fa fab fa-linkedin mr-1"></i> Sign in with LinkedIn
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasGithubSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::google()]) }}" class="btn btn-block btn-hero-primary bg-xwork">
            <i class="fa fab fa-github mr-1"></i> Sign in with GitHub
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasGitlabSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::gitlab()]) }}">
            <x-gitlab-icon class="h-6 w-6 mx-2" />
            <span class="sr-only">GitLab</span>
        </a>
    @endif

    @if (JoelButcher\Socialstream\Socialstream::hasBitbucketSupport())
        <a href="{{ route('oauth.redirect', ['provider' => JoelButcher\Socialstream\Providers::bitbucket()]) }}">
            <x-bitbucket-icon />
            <span class="sr-only">BitBucket</span>
        </a>
    @endif
