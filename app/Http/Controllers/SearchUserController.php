<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class SearchUserController extends Controller
{
    public function search(Request $request, Users $users)
    {
        $user = $users->all();
        if(!empty($request->search)){
            $searchEmail = [];
            foreach ($user as $email){
                if(strncasecmp($email['email'], $request->search, strlen($request->search)) == 0){
                    $searchEmail[] = collect([
                        'id' => $email['id'],
                        'email' => $email['email'],
                        'password' => $email['password']
                    ]);
                }
            }
            $searchEmail = $this->paginate($searchEmail);
            return view('AdminPanel.layout', ['users' => $searchEmail]);
        }
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
