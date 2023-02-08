@extends('layout.mainlayout')

@section('content')
    <div class="flex justify-center items-center">
        <div class="flex-row mt-32 bg-gray-200 px-4">
            <div class="flex justify-start">
                <h2 class="text-black text-3xl underline">{{__('Register')}}</h2>
            </div>
            <form action="{{route('register_create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-start mt-4">
                    <h2 class="text-black text-2xl">{{__('First Name')}}:</h2>
                    <input type="text" value="{{old('fname')}}" class="border w-64 ml-2 @error('fname') is-invalid @enderror" name="fname" id="fname">
                    <h2 class="text-black text-2xl ml-32 mr-20">{{__('Last Name')}}:</h2>
                    <input type="text" value="{{old('lname')}}" class="border w-64 ml-2 @error('lname') is-invalid @enderror" name="lname" id="lname">
                    @error('lname')
                    <div class="invalid-feedback text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                @error('fname')
                    <div class="invalid-feedback text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <div class="flex justify-start mt-4">
                    <h2 class="text-black text-2xl mr-14">Email: </h2>
                    <input type="text" value="{{old('email')}}" class="border w-64 ml-2 @error('email') is-invalid @enderror" name="email" id="email">
                    <h2 class="text-black text-2xl ml-32 mr-36">{{__('Role')}}:</h2>
                    <select class="border w-64 ml-3" name="role" id="role">
                        <option value="1" selected>User</option>
                        <option value="2">Admin</option>
                    </select>
                </div>
                @error('email')
                    <div class="invalid-feedback text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <div class="flex justify-start mt-4">
                    <h2 class="text-black text-2xl mr-14">{{__('Gender')}}:</h2>
                    <div class="form-check form-check-inline mr-4">
                        <input required class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="gender" id="male" value="1">
                        <label class="form-check-label inline-block text-gray-800" for="male"> {{__('Male')}} </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input required class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="gender" id="female" value="2">
                        <label class="form-check-label inline-block text-gray-800" for="female">{{__('Female')}}</label>
                    </div>
                    <h2 class="text-black text-2xl ml-56 mr-10">{{__('Display Picture')}}: </h2>
                    <div class="flex justify-end border bg-white w-64 ml-1">
                        <div class="flex justify-center bg-gray-400 px-2">
                            <label for="dp" class="button">{{__('Browse')}}</label>
                            <input id="dp" name="dp" class="hidden @error('dp') is-invalid @enderror" type="file">
                            @error('dp')
                                <div class="invalid-feedback text-red-500">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex justify-start mt-4">
                    <h2 class="text-black text-2xl mr-5">Password: </h2>
                    <input type="password" name="pass" id="pass" class="border w-64 @error('pass') is-invalid @enderror">
                    <h2 class="text-black text-2xl ml-32 mr-3">{{__('Confirm Password')}}: </h2>
                    <input type="password" name="repass" id="repass" class="border w-64 @error('repass') is-invalid @enderror">
                    @error('repass')
                    <div class="invalid-feedback text-red-500">
                        {{$message}}
                    </div>
                    @enderror

                </div>
                @error('pass')
                    <div class="invalid-feedback text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <div class="flex justify-center mt-8">
                    <button type="submit" class="bg-yellow-400 text-black border px-16 text-2xl">{{__('Submit')}}</button>
                </div>
            </form>
            <div class="flex justify-center mt-2">
                <a href="{{route('login')}}" class="text-blue-500">{{__('Already have an account? click here to log in')}}</a>
            </div>
        </div>
    </div>
@endsection

