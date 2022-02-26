@extends('Frontend.main_master')

@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')
            <div class="col-md-2">
                
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center">
                        <div class="text-danger">Hello <strong>{{ Auth::user()->name }}</strong> Welcome to the Grabit Ecommerce</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Hi..{{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        This is just home page 
    </div>
</x-app-layout> --}}
