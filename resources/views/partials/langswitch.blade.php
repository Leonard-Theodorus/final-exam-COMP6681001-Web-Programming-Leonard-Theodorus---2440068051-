@foreach(Config::get('app.available_locales') as $locale_name => $available_locale)
        <a class="ml-1 underline ml-2 mr-2" href="language/{{$available_locale}}">
            <span>{{ $locale_name }}</span>
        </a>
@endforeach
</div>
