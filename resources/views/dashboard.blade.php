@extends('Frontend.main_master')

@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img class="img-card-top" height="100%" width="100%" style="border-radius:50%"  src="{{ !empty($adminData->profile_photo_path)? url('upload/admin_images/'.$adminData->profile_photo_path):url('upload/no_image.jpg') }}" alt="User Avatar">
                <ul class="list-group list-group-flush">
                    <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="" class="btn btn-primary btn-sm btn-block">Logout</a>
                </ul>
            </div>
            <div class="col-md-2">
                
            </div>
            <div class="col-md-8">
                
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
