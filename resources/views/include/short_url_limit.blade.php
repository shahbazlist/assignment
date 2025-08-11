@if($urls )
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4">Generated Short URLs</h1>
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
    @endif