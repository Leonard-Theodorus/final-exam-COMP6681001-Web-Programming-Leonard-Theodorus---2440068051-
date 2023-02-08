@extends('layout.mainlayout')

@section('content')
    <div class="flex-row">
        <div class="flex justify-center mt-32 ml-24">
            <div class="grid grid-cols-5 gap-12">
                @foreach ($veggies as $v)
                <div class="w-1/2 px-2">
                    <img src= "{{$v->item_pic}}"  alt="item picture" class="shadow rounded-full border-none" />
                    <div class="flex justify-center">
                        <div class="flex-row">
                            <p class="text-black ml-3"> {{$v->item_name }}</p>
                            <a href="/detail/{{$v->id}}" class="text-blue-500 ml-6">{{__('Detail')}}</a>
                            {{-- <form action="{{route('detail', ['id' => $v->id])}}">
                                @csrf
                                <button class="text-blue-500 ml-6">{{__('Detail')}}</button>

                            </form> --}}
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex justify-center mt-32">
            {{$veggies->links()}}
        </div>

    </div>
@endsection
