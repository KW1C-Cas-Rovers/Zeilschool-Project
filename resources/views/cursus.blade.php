@extends('layouts.main')

@section('content')
    <div class="container mt-10">
        {{-- <h1>Cursus</h1> --}}
        <div class="flex flex-row items-center text-center">
            <div class="w-1/3 px-2">
                <div>
                    <img src="{{ asset('images/zeilboot.jpg') }}" alt="zeilboot">
                </div>
            </div>
            <div class="w-1/3 px-2">
                <h2>Cursus</h2>
            </div>
            <div class="w-1/3 px-2">
                <h2>Cursus</h2>
            </div>
        </div>
    </div>
@endsection
