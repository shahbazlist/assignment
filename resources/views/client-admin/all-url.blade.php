<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto p-4">
                <a href="{{ url()->previous() }}" class="btn btn-primary rounded text-1xl font-bold mb-4">
                    Back
                </a>
                <div class="flex justify-between items-center mb-4">

                    <h1 class="text-2xl font-bold">Generated Short URLs</h1>
                    <button class="btn btn-success rounded text-1xl font-bold mb-4" data-bs-toggle="modal"
                        data-bs-target="#newShortUrl">
                        + ShortURL
                    </button>
                    <div class="flex items-center space-x-3">
                        <select id="url_filter" class="form-control">
                            <option value="" @if (request('filter') == '') selected @endif>Filter</option>
                            <option value="1" @if (request('filter') == '1') selected @endif>This Month</option>
                            <option value="2" @if (request('filter') == '2') selected @endif>Last Month</option>
                            <option value="3" @if (request('filter') == '3') selected @endif>Last Week</option>
                            <option value="4" @if (request('filter') == '4') selected @endif>Today</option>
                        </select>

                        <a class="btn btn-success" href="{{route('export-shorturl', ['filter' => request('filter')])}}">
                                Download
                            </a>
                    </div>
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
                                <td class="border px-4 py-2">{{ $user->name }}<br><small>{{ $user->email }}</small>
                                </td>
                                <td class="border px-4 py-2">{{ count($user->children) }}</td>
                                <td class="border px-4 py-2">{{ $user->short_urls_count }}</td>
                                <td class="border px-4 py-2">{{ $user->short_urls_sum_hits ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $result->links() }}
            </div>
        </div>
        {{-- Modal Popup Start --}}
        @include('include.new_short_url_modal')
        {{-- Modal Popup End --}}
    </div>
</x-app-layout>
<script src="{{ asset('assets/js/form.js') }}"></script>
