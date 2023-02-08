@extends('layout.mainlayout')

@section('content')
    <div class="flex justify-center  mt-16">
        <div class="flex-row mr-16  w-1/4">
            <h2 class="text-black underline text-2xl mb-16"> {{$item->item_name}} </h2>
            <img src="{{$item->item_pic}}" class="shadow rounded-full border-none w-44 h-44" alt="item picture">
        </div>
        <div class="flex-row w-1/2">
            <h2 class="text-black text-2xl">{{__('Price')}}: Rp. {{$item->price}}</h2>

            @foreach ($desc as $d )
                <h2 class="text-black text-2xl mt-8"> {{$d}} </h2>
            @endforeach
        </div>
    </div>
    <div class="flex justify-end w-3/4 mt-16">
        <form action="{{route('buy')}}" method="post">
            @csrf
            <input type="hidden" name="item_id" value="{{$item->id}}">
            <button class="bg-yellow-400 text-black border px-12 py-2  text-2xl">{{__('Buy')}}</button>
        </form>
    </div>
@endsection
