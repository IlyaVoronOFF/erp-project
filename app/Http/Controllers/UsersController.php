<?php

namespace App\Http\Controllers;

use App\Http\Requests\usersstore;
use App\Http\Requests\usersupdate;
use App\Models\Part;
use App\Models\Rule;
use App\Models\Special;
use App\Models\User;
use App\Models\UserParts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->join('rules', 'users.rule_id', '=', 'rules.id')
            ->join('speciality', 'users.special_id', '=', 'speciality.id')
            ->select('users.*', DB::raw('rules.name as rule_name'), DB::raw('speciality.name as speciality_name'))
            ->get();

        $parts = DB::table('users_parts')
            ->join('users', 'users_parts.user_id', '=', 'users.id')
            ->join('parts', 'users_parts.part_id', '=', 'parts.id')
            ->select('users_parts.*', DB::raw('parts.short_name as partShort_name'))
            ->get();

        return view('pages.users.index', ['usersList' => $users, 'partsList' => $parts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rules = Rule::select(['id', 'name'])
            ->get();
        $specs = Special::select(['id', 'name'])
            ->get();
        $parts = Part::select(['parts.*'])
            ->get();

        return view('pages.users.create', ['ruleList' => $rules, 'specList' => $specs, 'partList' => $parts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(usersstore $request, User $user)
    {
        $request['num_pass'] = $request['password'];
        $request['password'] = Hash::make($request['password']);
        $data = $request->only(['id', 'fio', 'email', 'phone', 'password', 'num_pass', 'rule_id', 'special_id', 'oklad']);
        $status = $user->fill($data)->save();

        $partArr = [];

        if (!empty($request->get('parts'))) {
            foreach ($request->get('parts') as $part) {
                $partArr[] = new UserParts(['user_id' => $user->fill(['id']), 'part_id' => $part]);
            }
        }

        if (!empty($partArr)) {
            $user->parts()->saveMany($partArr);
        }

        if ($status) {
            return redirect()->route('pages.users.index')
                ->with('success', trans('messages.users.create.success'));
        }

        return back()->with('error', trans('messages.users.create.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $rules = Rule::select(['id', 'name'])
            ->orderBy('id', 'asc')
            ->get();
        $specs = Special::select(['id', 'name'])
            ->orderBy('id', 'asc')
            ->get();
        $parts = Part::select(['parts.*'])
            ->orderBy('id', 'asc')
            ->get();
        $userParts = UserParts::select(['part_id'])
            ->where('user_id', $user->id)
            ->get();

        return view('pages.users.edit', ['userId' => $user, 'ruleList' => $rules, 'specList' => $specs, 'partList' => $parts, 'partsUser' => $userParts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(usersupdate $request, User $user)
    {
        $request['num_pass'] = $request['password'];
        $request['password'] = Hash::make($request['password']);
        $data = $request->only(['id', 'fio', 'email', 'phone', 'password', 'num_pass', 'rule_id', 'special_id', 'oklad']);
        $status = $user->fill($data)->save();

        $partArr = [];

        if (!empty($request->get('parts'))) {
            foreach ($request->get('parts') as $part) {
                $partArr[] = new UserParts(['user_id' => $user->fill(['id']), 'part_id' => $part]);
            }
        }

        if (!empty($partArr)) {
            $user->parts()->delete();
            $user->parts()->saveMany($partArr);
        }

        if ($status) {
            return redirect()->route('pages.users.index')
                ->with('success', trans('messages.users.update.success'));
        }

        return back()->with('error', trans('messages.users.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->ajax()) {
            try {
                $status = $user->delete();
                $user->parts()->delete();

                if ($status) {
                    return redirect()->route('pages.users.index')
                        ->with('success', __('messages.users.delete.success'));
                }
                return back()->with('error', __('messages.users.delete.fail'));
            } catch (\Throwable $th) {
                report($th);
            }
        }
    }
}