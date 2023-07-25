<x-navbar>
    <label for="my-drawer-2" class="btn btn-square btn-ghost drawer-button lg:hidden">
        <x-menu-icon></x-menu-icon>
    </label>
    

    <a href="/" class="text-xl font-bold">PT. Surya Wira Abadi Tribuana</a>

    <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-outline hover:btn-ghost m-1">{{Auth::user()->nama}}</label>
        <div tabindex="0" class="dropdown-content p-2 shadow bg-base-100 rounded-box w-52 border grid gap-2">
            <a class="btn btn-ghost" href="{{route('profile.edit')}}">edit profile</a>
            <form  method="post" action="{{route('logout')}}" class="inline-flex">
                @csrf
                <button class="btn btn-ghost text-error w-full">logout</button>
            </form>
        </div>
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
      <li><a href="{{route('jadwal-absensi.index')}}">Jadwal</a></li>
      <li><a href="{{route('list-jadwal-lembur')}}">Jadwal lembur</a></li>
      <li><a href="{{route('index-slip')}}">Slip Gaji</a></li>
    </ul>
  
  </div>
</div>