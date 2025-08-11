<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="container mx-auto p-4">
                    <h1 class="text-2xl font-bold mb-4">Generated Short URLs</h1>
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
                            @foreach ($urls as $user)
                            <tr>
                                <td class="border px-4 py-2">{{ $user->name }}<br><small>{{ $user->email }}</small></td>
                                <td class="border px-4 py-2">{{count($user->children)}}</td>
                                <td class="border px-4 py-2">{{ $user->short_urls_count }}</td>
                                <td class="border px-4 py-2">{{ $user->short_urls_sum_hits ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $urls->links() }}
                </div>
            </div>
        </div>
</x-app-layout>
