<nav class="bg-green-200 px-12 py-4 flex justify-center items-center">
    <a href="/" class="text-black font-bold text-center text-3xl">Amazing E-Grocery</a>
    <div class="bg-yellow-300 px-2 text-2xl ml-16">
        @cannot('auth')
        <a href="{{route('register')}}" class="@auth
            hidden
        @endauth rounded text-black px-4">{{__('Register')}}</a>
        <a href="{{route('login')}}" class="@auth
            hidden
        @endauth rounded text-black px-4">{{__('Login')}}</a>
        @endcannot
        @auth
            <a href="{{route('logout')}}" class="button rounded text-black px-4">Logout</a>
        @endauth
        @include('partials.langswitch')
    </div>
</nav>
@auth
    <div class="flex bg-yellow-400 justify-around px-32">
        <a href="{{route('welcome')}}" class="hover:underline text-black text-2xl">Home</a>
        <a href="{{route('cart')}}" class="hover:underline text-black text-2xl">{{__('Cart')}}</a>
        <a href="{{route('profile')}}" class="hover:underline text-black text-2xl">{{__('Profile')}}</a>
        @can('admin')
            <a href="{{route('maintanance')}}" class="hover:underline text-black text-2xl">{{__('Account Maintanance')}}</a>
        @endcan
    </div>
@endauth
