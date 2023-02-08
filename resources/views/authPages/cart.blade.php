@extends('layout.mainlayout')

@section('content')
    @if(session()->has('del_succ'))
    <div class="alert alert-danger alert-dismissible fade show text-red-500" role="alert">
        {{session('del_succ')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session()->has('empty_cart'))
    <div class="alert alert-danger alert-dismissible fade show text-red-500" role="alert">
        {{session('empty_cart')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session()->has('buy_succ'))
    <div class="alert alert-danger alert-dismissible fade show text-green-500" role="alert">
        {{session('buy_succ')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="flex justify-start mt-8 px-56 ml-24 mb-8">
        <h2 class="text-black text-3xl font-bold underline">{{__('Cart')}}</h2>
    </div>
        @php
            $total = 0;
        @endphp
        @foreach ($item as $i)
            @php
                $total += $i->price;
            @endphp
            <div class="flex-row mb-20 w-full px-56">
                    <div class="flex justify-around items-center">
                        <img src="{{$i->item_pic}}" class="shadow rounded-full border-none w-28 h-28" alt="item picture">
                        <h2 class="text-black text-2xl">{{$i->item_name}}</h2>
                        <h2 class="text-black text-2xl">Rp. {{$i->price}}</h2>
                        <form action="{{route('del_cart')}}" method="post">
                            @csrf
                            <input type="hidden" name="del_id" value="{{$i->item_id}}">
                            <button class="text-blue-500 underline text-xl">{{__('Delete')}}</button>
                        </form>
                    </div>
            </div>
        @endforeach
        <div class="flex justify-end w-3/4">
            <h2 class="text-black font-bold text-3xl">TOTAL: </h2>
            <h2 class="text-black text-3xl ml-4">Rp. {{$total}}</h2>
            <form action="{{route('cout', ['user' => auth()->user()->id])}}" method="post">
                @csrf
                <button class="bg-yellow-400 text-black border px-4 text-2xl ml-4">Check Out</button>
            </form>
        </div>
@endsection
