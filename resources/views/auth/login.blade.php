<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="grid gap-4">
        @csrf

        <!-- Email Address -->
        <x-form-control>
            <x-label>email</x-label>
            <x-text-input 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
            />
            @error("email")
                <x-error-label>{{$message}}</x-error-label>
            @enderror 
        </x-form-control>

        <!-- Password -->
        
        <x-form-control>
            <x-label>password</x-label>
            <x-text-input 
                type="password" 
                name="password" 
                required 
                autofocus 
                autocomplete="current-password"
            />
        </x-form-control>

        <x-toggle name="remember" label="Remember me"/>

        <div class="flex items-center justify-end mt-4 gap-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn">Log in</button>
        </div>
    </form>
</x-guest-layout>
