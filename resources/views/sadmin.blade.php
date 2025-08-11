<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @include('include.clients_limit')
    @include('include.short_url_limit')
    
    {{-- Modal Popup Start --}}
    
    @include('include.new_client_modal')
    @include('include.new_short_url_modal')
    
    {{-- Modal Popup End --}}
</x-app-layout>
<script src="{{ asset('assets/js/form.js') }}"></script>

