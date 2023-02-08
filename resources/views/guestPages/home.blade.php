@extends('layout.mainlayout')
@section('content')
<div class="flex justify-center items-center mt-16">
        <div class="bg-yellow-300 rounded-full px-4 py-4">
            <div class="font-bold text-black rounded-full bg-white flex items-center justify-center" style="height: 500px; width: 500px; font-size: 30px;">
                @if ($log == 1)
                    {{__('Log Out Success!')}}
                    @else
                    {{__('Find and Buy Your Grocery Here!')}}
                @endif
            </div>
        </div>
</div>
@endsection
