@extends('layout.mainlayout')

@section('content')
    <div class="flex mt-16 px-24">
        <h2 class="text-black underline text-2xl"> {{$name}} </h2>
    </div>
    <div class="flex mt-16 px-24">
        <h2 class="text-black text-2xl">{{__('Role')}}:</h2>
        <form action="{{route('chrole')}}" method="post">
            @csrf
            <select class="border-2 border-black w-64 ml-24" name="role" id="role">
                <option value="1" @if ($role == 1)
                    selected
                @endif>User</option>
                <option value="2" @if ($role == 2)
                    selected
                @endif>Admin</option>
            </select>
        </div>
        <div class="flex mt-8 px-20 ml-8">
            <input type="hidden" name="id" value="{{$id}}">
            <button type="submit" class="bg-yellow-400 text-black border px-8 py-2 text-2xl">{{__('Update Role')}}</button>
        </div>
    </form>
@endsection
