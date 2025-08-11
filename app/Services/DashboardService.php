<?php

namespace App\Services;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DashboardService
{
    public function getUsers($tab, $filter = null)
    {
        $paginate = $tab == 'dashboard' ? 2 : 10;

        $roleIds = Auth::user()->roles->first()->id;
        $urls = null;
        $view = '';
        $roles = '';
        if ($roleIds == 1) {
            $view = 'super-admin.' . $tab;
        }

        if ($roleIds == 2) {
            $roles = Role::where('id', '!=', 1)->pluck('name', 'name')->toArray();
            $view = 'client-admin.' . $tab;
        }

        if ($roleIds == 3) {
            $view = 'client-member.' . $tab;
        }
        
        $urls = ShortUrl::when(Auth::user()->roles->first()->id == 3, function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->when($filter, function ($query, $filter) {
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
                        $query->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
                        break;
                    case '4':
                        $query->whereDate('created_at', now()->toDateString());
                        break;
                }
            })
            ->byParentUsers()
            ->with('user')
            ->latest()
            ->paginate(2);


        $user = User::withCount('shortUrls')
            ->withSum('shortUrls', 'hits')
            ->when(Auth::user()->roles->first()->id != 1, function ($query) {
                $query->where('parent_id', Auth::id());
            })
            ->when($filter, function ($query, $filter) {
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
                        $query->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
                        break;
                    case '4':
                        $query->whereDate('created_at', now()->toDateString());
                        break;
                }
            })
            ->latest()
            ->paginate($paginate);

        return ['view' => $view, 'users' => $user, 'urls' => $urls, 'roles'=> $roles];
    }

    public function getAllUrl($filter = null)
    {
        $ParentUsers = User::where('parent_id', Auth::id())->pluck('id');
        return ShortUrl::when($filter, function ($query, $filter) {
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
                        $query->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()]);
                        break;
                    case '4':
                        $query->whereDate('created_at', now()->toDateString());
                        break;
                }
            })
            ->when(Auth::user()->roles->first()->id != 3, function ($query, $ParentUsers) {
                $query->whereIn('user_id', $ParentUsers);
            })
            ->when(Auth::user()->roles->first()->id == 3, function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->paginate(10);
    }

    public function getAllUsers($request)
    {
        return User::where('parent_id', Auth::id())->with('children')->latest()->paginate(10);
    }

    public function inviteClient(array $data): User
    {
        $plainPassword = Str::random(10);
        $data['password'] = Hash::make($plainPassword);
        $data['parent_id'] = Auth::id();
        $user = User::create($data);
        $roleIds = Auth::user()->roles->first()->id;
        if ($roleIds == 1) {
            $role = Role::find(1);
            if ($role) {
                $user->assignRole($role);
            }
        } else {
            if ($data['role']) {
                $user->assignRole($data['role']);
            }
        }
        if ($user->email) {
            $url = url('/login');
            Mail::to($user->email)->send(new \App\Mail\ClientInvitationMail($user->name, $user->email, $plainPassword, $url));
        }
        return $user;
    }
}
