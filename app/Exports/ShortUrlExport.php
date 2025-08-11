<?php

namespace App\Exports;

use App\Models\ShortUrl;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;


class ShortUrlExport implements FromCollection, WithHeadings
{
    protected $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $parentUsers = User::where('parent_id', Auth::id())->pluck('id')->push(Auth::id());

        $shortUrls = ShortUrl::with('user')
            ->when($this->filter, function ($query, $filter) {
                switch ($filter) {
                    case '1':
                        $query->whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year);
                        break;
                    case '2':
                        $query->whereMonth('created_at', now()->subMonth()->month)
                            ->whereYear('created_at', now()->subMonth()->year);
                        break;
                    case '3':
                        $query->whereBetween('created_at', [
                            now()->subWeek()->startOfWeek(),
                            now()->subWeek()->endOfWeek()
                        ]);
                        break;
                    case '4':
                        $query->whereDate('created_at', now()->toDateString());
                        break;
                }
            })
            ->when(Auth::user()->roles->first()->id == 2, function ($query) use ($parentUsers) {
                $query->whereIn('user_id', $parentUsers);
            })
            ->when(Auth::user()->roles->first()->id == 3, function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();

        return $shortUrls->map(function ($url) {
            return [
                'ShortURL'   => url('') . '/' . $url->token,
                'Long URL'   => $url->url,
                'Hits'       => $url->hits,
                'Client Name' => $url->user ? $url->user->name : '',
                'Created On' => $url->created_at->format("d M 'y"),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ShortURL',
            'Long URL',
            'Hits',
            'Client Name',
            'Created On',
        ];
    }
}
