@extends('layout.mainlayout')
@section('content')
<div class="flex justify-center items-center mt-16">
    <div class="bg-yellow-300 rounded-full px-4 py-4">
        <div class="text-black rounded-full bg-white flex items-center justify-center" style="height: 500px; width: 500px;">
            @if($profile == 0)
            <div class="flex-row  w-full">
                <h2 class="text-4xl text-center font-bold mb-20">{{__('Success')}}!</h2>
                <h2 class="text-2xl text-center mb-8">{{__('We will contact you 1x24 hours')}}.</h2>
                <div class="flex justify-center">
                    <a href="/welcome" class="text-blue-500 underline">{{__('Click here to "Home"')}}</a>
                </div>
            </div>
            @else
            <div class="flex-row  w-full">
                <h2 class="text-4xl text-center font-bold mb-8">{{__('Saved')}}!</h2>
                <div class="flex justify-center">
                    <a href="/welcome" class="text-blue-500 underline">{{__('Click here to "Home"')}}</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
