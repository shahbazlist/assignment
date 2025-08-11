<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Clients</h1>
                <button class="btn btn-success rounded text-1xl font-bold mb-4" data-bs-toggle="modal" data-bs-target="#newClient">
                    + Invite
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-primary rounded text-1xl font-bold mb-4">
                    Back
                </a>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Client Name</th>
                        <th class="border px-4 py-2">Users</th>
                        <th class="border px-4 py-2">Total Generate URLs</th>
                        <th class="border px-4 py-2">Total URL Hits</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->name }}<br><small>{{ $user->email }}</small></td>
                            <td class="border px-4 py-2">{{ count($user->children) }}</td>
                            <td class="border px-4 py-2">{{ $user->short_urls_count }}</td>
                            <td class="border px-4 py-2">{{ $user->short_urls_sum_hits ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $result->links() }}
        </div>
        {{-- Modal Popup Start --}}
        @include('include.new_client_modal')
        {{-- Modal Popup End --}}
    </div>
</x-app-layout>
<script src="{{ asset('assets/js/form.js') }}"></script>
