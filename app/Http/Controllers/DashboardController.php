<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\ShortUrl;
use App\Models\User;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class DashboardController extends Controller
{
    public function index(Request $request,$tab = 'dashboard')
    {
        $data = (new DashboardService())->getUsers($tab, $request->filter);
        $result = $data['users'];
        $urls = $data['urls'];
        $roles = $data['roles'];
        return view($data['view'], compact('result', 'urls', 'roles'));
    }

    public function shorturl_all(Request $request)
    {
        $result = (new DashboardService())->getAllUrl($request->filter);
        return view('super-admin.all-url', compact('result'));
    }


    public function inviteclient(StoreClientRequest $request)
    {
        $data = $request->only(['name', 'email', 'role']);
        $user = (new DashboardService())->inviteClient($data);
        if ($user) {
            return response()->json(['status' => true, 'message' => 'Success']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong!']);
        }
    }
}
