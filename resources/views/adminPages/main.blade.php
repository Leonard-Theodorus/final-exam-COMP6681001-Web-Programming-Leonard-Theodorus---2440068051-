@extends('layout.mainlayout')

@section('content')
@if(session()->has('role_succ'))
<div class="alert alert-danger alert-dismissible fade show text-green-500" role="alert">
    {{session('role_succ')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('del_succ'))
<div class="alert alert-danger alert-dismissible fade show text-green-500" role="alert">
    {{session('del_succ')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
    <div class="flex justify-around px-56">
        <div class="flex w-full ">
            <div class="flex-row">
                <h2 class="text-black text-center underline text-2xl">{{__('Account')}}</h2>
                @foreach ($acc as $a)
                <div class="flex-row">
                    <div class="flex px-20 py-2 border border-solid border-2 border-black">
                        <div class="flex px-20">
                            @if ($a->role_id == 1)
                            <h2 class="text-black"> {{$a->first_name . " " . $a->last_name . " - " . "User"}} </h2>
                                @else
                                <h2 class="text-black"> {{$a->first_name . " " . $a->last_name . " - " . "Admin"}} </h2>
                            @endif
                        </div>
                    </div>
                 @endforeach
                </div>
            </div>
        </div>
        <div class="flex w-full">
            <div class="flex-row">
                <h2 class="text-black text-center underline text-2xl">{{__('Action')}}</h2>
                @foreach ($acc as $a)
                    <div class="flex-row">
                        <div class="flex w-full px-16 py-2 border-solid border-2 border-black">
                            <div class="flex px-16">
                                <a href="/updaterole/{{$a->id}}" class="text-blue-500 underline mr-16">{{__('Update Role')}}</a>
                                <form action="{{route('dell_acc', ['id' => $a->id])}}" method="post">
                                    @csrf
                                    <button class="text-blue-500 underline">{{__('Delete')}}</button>
                                </form>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
