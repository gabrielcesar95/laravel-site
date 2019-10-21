@extends('web.layouts.main')

@section('title', env('APP_NAME'))


@section('content')
    @include('web.layouts.navbar')
    <section class="container bg-primary text-white py-4">
        <h1 class="text-center">Home Page</h1>

    </section>
    <section class="container border py-5">
        <p>Esse site ainda está sendo desenvolvido</p>
    </section>
    @include('web.layouts.footer')
@endsection

@push('js')
    <script>

    </script>
@endpush

@push('css')
    <style>

    </style>
@endpush
