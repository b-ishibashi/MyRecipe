@extends('layouts.default')

@section('content')
    <div class="welcome">
        <div class="d-flex flex-column align-items-center">
            <section class="welcome-inner-wrapper d-flex flex-column">
                <p class="display-4 text-center">
                    My Recipe<br>
                    <a class="btn btn-primary" href="{{ action('RegisterController@create') }}">無料で始める</a>
                    <aside>渾身の手料理を共有しましょう。</aside>
                </p>
            </section>
        </div>
    </div>
@endsection




