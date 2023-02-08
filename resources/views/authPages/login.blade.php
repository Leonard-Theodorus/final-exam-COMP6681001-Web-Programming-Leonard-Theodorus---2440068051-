@extends('layout.mainlayout')

@section('content')
<div class="flex justify-center items-center">
    <div class="flex-row mt-32 bg-gray-200 px-4">
        <div class="flex justify-start">
            @if(session()->has('login_error'))
            <div class="alert alert-danger alert-dismissible fade show text-red-500" role="alert">
                {{session('login_error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session()->has('reg_succ'))
            <div class="alert alert-danger alert-dismissible fade show text-green-500" role="alert">
                {{session('reg_succ')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <h2 class="text-black text-3xl underline">{{__('Login')}}</h2>
        </div>
        <form action="{{route('login_create')}}" method="post">
            @csrf
            <div class="flex justify-start mt-4">
                <h2 class="text-black text-2xl mr-14">{{__('Email Address')}}: </h2>
                <input type="email" class="border w-64 ml-2" name="email" id="email">
            </div>
            <div class="flex justify-start mt-4">
                <h2 class="text-black text-2xl  mr-24">Password: </h2>
                <input type="password" class="border w-64 ml-4" name="pass" id="pass">
            </div>
            <div class="flex justify-center mt-8">
                <button type="submit" class="bg-yellow-400 text-black border px-16 text-2xl">{{__('Login')}}</button>
            </div>
        </form>
        <div class="flex justify-center mt-2">
            <a href="{{route('register')}}" class="text-blue-500">{{__('Don`t have an account? click here to sign up')}}</a>
        </div>
    </div>
</div>
@endsection
