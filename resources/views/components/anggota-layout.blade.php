<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <x-navbar>
            <label for="my-drawer-2" class="btn btn-square btn-ghost drawer-button lg:hidden">
                <x-menu-icon></x-menu-icon>
            </label>
            

            <a href="/" class="text-xl font-bold">PT. xxx</a>

            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-outline hover:btn-ghost m-1">{{Auth::user()->nama}}</label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 border ">
                    <li><a href="{{route('profile.edit')}}">edit profile</a></li>
                    <li><form method="post" action="{{route('logout')}}">
                        @csrf
                        <button type="submit">logout</button>
                    </form></li>
                </ul>
            </div>
        </x-navbar>

        <div class="drawer drawer-mobile">
          <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
          <div class="drawer-content pt-24 px-6">
            <!-- Page content here -->

            {{$slot}}
          
          </div> 
          <div class="drawer-side">
            <label for="my-drawer-2" class="drawer-overlay"></label> 
            <ul class="menu p-4 pt-24 w-72 bg-base-200 text-base-content">
              <!-- Sidebar content here -->
              <li><a href="{{ route('jadwal-anggota.index') }}">Jadwal</a></li>
            </ul>
          
          </div>
        </div>
    </body>
</html>
