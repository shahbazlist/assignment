<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto p-4">
                {{-- <div class=" flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Generated Short URLs</h1>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newShortUrl">
                        + ShortURL
                    </button>
                </div> --}}
                <div class=" flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Generated Short URLs</h1>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newShortUrl">
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

                        <button class="btn btn-success">
                            Download
                        </button>
                    </div>
                </div>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Short URL</th>
                            <th class="border px-4 py-2">Long URL</th>
                            <th class="border px-4 py-2">Hits</th>
                            <th class="border px-4 py-2">Client Name</th>
                            <th class="border px-4 py-2">Created On</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($urls as $url)
                            <tr>
                                <td class="border px-4 py-2">{{ url('') . '/' . $url->token }}</td>
                                <td class="border px-4 py-2">{{ $url->url }}</td>
                                <td class="border px-4 py-2">{{ $url->hits }}</td>
                                <td class="border px-4 py-2">{{ $url->user->name }}</td>
                                <td class="border px-4 py-2">{{ date("d M 'y", strtotime($url->created_at)) }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($urls->total() > $urls->perPage())
                    {{ 'Showing ' . $urls->lastItem() . ' of total ' . $urls->total() }}
                    <a href="{{ route('dashboard.shorurl_all') }}" class="btn btn-success">View All</a>
                @endif

            </div>
        </div>
    </div>


    {{-- Modal Popup Start --}}
    @include('include.new_short_url_modal')
    {{-- Modal Popup End --}}
</x-app-layout>
<script src="{{ asset('assets/js/form.js') }}"></script>
