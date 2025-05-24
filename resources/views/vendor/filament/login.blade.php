<form wire:submit.prevent="authenticate" class="space-y-8">
    {{ $this->form }}

    <x-filament::button type="submit" form="authenticate" class="w-full">
        {{ __('filament::login.buttons.submit.label') }}
    </x-filament::button>
</form>

<div class="relative flex items justify-center mt-4 hover:underline">
    @if (Route::has('auth.register'))
             <a href="{{ route('auth.register') }}" class="ml-4 text-gray-700 dark:text-gray-100 font-semibold">Don't have an account? Register Here</a>
        @endif
</div>

<div class="flex items-center justify-start mb-4 mt-4">
    <a href="{{ route('welcome') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">
        ← Back
    </a>
</div>
