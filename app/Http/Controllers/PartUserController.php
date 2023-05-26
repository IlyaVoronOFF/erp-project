<?php

namespace App\Http\Controllers;

use App\Http\Requests\partuserstore;
use App\Models\ObjectModel;
use App\Models\ObjectParts;
use App\Models\PartUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $object = $request->object;
        $part = $request->part;
        $parts = ObjectParts::select('object_parts.*', DB::raw('objects.title as object'), DB::raw('parts.name as part'), DB::raw('users.fio as user'))
            ->where('object_parts.id', $request->part)
            ->join('objects', 'object_parts.object_id', '=', 'objects.id')
            ->join('parts', 'object_parts.part_id', '=', 'parts.id')
            ->join('users', 'object_parts.user_id', '=', 'users.id')
            ->get();
        $objUser = ObjectModel::select('objects.*', DB::raw('users.fio as user'))
            ->where('objects.id', $request->object)
            ->join('users', 'objects.user_id', '=', 'users.id')
            ->get();

        $events = [];
        $countTime = 0;
        $partUser = PartUser::where('object_parts_id', $request->part)
            ->get();
        foreach ($partUser as $i) {
            $events[] = [
                'id' => $i->id,
                'title' => $i->time,
                'start' => $i->date,
                'description' => $i->description,
                'end' => $i->date,
                'allDay' => false
            ];
            $countTime = $countTime + $i->time;
        }

        return
            view('pages.part-user.index', ['user_object' => $objUser[0], 'objPartsList' => $parts, 'object_id' => $object, 'part_id' => $part, 'events' => $events, 'count' => $countTime, 'dataEvents' => $partUser]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(partuserstore $request, PartUser $partuser)
    {
        $data = $request->only(['id', 'object_parts_id', 'object_parts_object_id', 'date', 'time', 'description']);
        $status = $partuser->fill($data)->save();

        if ($status) {
            return back()->with('success', __('messages.part-user.create.success'));
        }
        return back()->with('error', __('messages.part-user.create.fail'));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            try {
                $status = PartUser::destroy($id);

                if ($status) {
                    return back()
                        ->with('success', __('messages.part-user.delete.success'));
                }
                return back()->with('error', __('messages.part-user.delete.fail'));
            } catch (\Throwable $th) {
                report($th);
            }
        }
    }
}