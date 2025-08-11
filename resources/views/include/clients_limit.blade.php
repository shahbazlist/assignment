<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Clients</h1>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newClient">
                    + New
                </button>
            </div>
            <div class="alert alert-success success-message" role="alert" style="display: none"></div>
            <div class="alert alert-danger error-message" role="alert" style="display: none"></div>
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
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">20</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($result->total() > $result->perPage())
                {{ 'Showing ' . $result->lastItem() . ' of total ' . $result->total() }}
                <a href="" class="btn btn-success">View All</a>
            @endif

        </div>
    </div>