<?php

namespace App\Http\Controllers;

use App\Http\Requests\objectpartsstore;
use App\Http\Requests\objectpartsupdate;
use App\Models\ObjectModel;
use App\Models\ObjectParts;
use App\Models\Part;
use App\Models\PartUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjectPartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = ObjectModel::select('objects.*', DB::raw('stages.short_name as stage'), DB::raw('users.fio as user'))
            ->where('objects.id', $request->object)
            ->join('stages', 'objects.stage_id', '=', 'stages.id')
            ->join('users', 'objects.user_id', '=', 'users.id')
            ->get();

        $parts = ObjectParts::select('object_parts.*', DB::raw('parts.name as part'), DB::raw('users.fio as user'))
            ->where('object_parts.object_id', $request->object)
            ->join('parts', 'object_parts.part_id', '=', 'parts.id')
            ->join('users', 'object_parts.user_id', '=', 'users.id')
            ->get();

        $events = collect([]);
        foreach ($parts as $i) {
            $events[] = PartUser::select('part_user.time')
                ->where('part_user.object_parts_id', $i->id)
                ->get();
        }

        $timeParts = $parts->sum('time');

        $setEvents = collect([]);
        foreach ($events as $i) {
            $setEvents[] = $i->pipe(function ($i) {
                return collect([
                    'total_time' => $i->sum('time'),
                ]);
            });
        }

        $timeEvents = $setEvents->sum('total_time');

        if ($timeParts && $timeEvents) {
            $progress = round(100 / ($timeParts / $timeEvents));
        } else {
            $progress = 0;
        }

        return
            view('pages.object-parts.index', ['objectId' => $objects[0], 'objPartsList' => $parts, 'progress' => $progress]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $object = $request->object;
        $parts = Part::select(['id', 'name'])
            ->orderBy('id', 'asc')
            ->get();
        $users = User::select(['id', 'fio'])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.object-parts.create', ['partList' => $parts, 'userList' => $users, 'object_id' => $object]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(objectpartsstore $request, ObjectParts $parts)
    {
        $data = $request->only(['id', 'object_id', 'part_id', 'user_id', 'daterange', 'time', 'fot_part', 'description']);
        $status = $parts->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.object-parts.index', ['object' => $request->object_id])
                ->with('success', trans('messages.object-parts.create.success'));
        }

        return back()->with('error', trans('messages.object-parts.create.fail'));
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
    public function edit(ObjectParts $object_part)
    {
        $parts = Part::select(['id', 'name'])
            ->orderBy('id', 'asc')
            ->get();
        $users = User::select(['id', 'fio'])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.object-parts.edit', ['partList' => $parts, 'userList' => $users, 'objectId' => $object_part]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(objectpartsupdate $request, ObjectParts $object_part)
    {
        $data = $request->only(['id', 'object_id', 'part_id', 'user_id', 'daterange', 'time', 'fot_part', 'description']);
        $status = $object_part->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.object-parts.index', ['object' => $object_part->object_id])
                ->with('success', trans('messages.object-parts.update.success'));
        }

        return back()->with('error', trans('messages.object-parts.update.fail'));
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
                $status = ObjectParts::destroy($id);
                PartUser::where('object_parts_id', $id)->delete();

                if ($status) {
                    return redirect()->route('pages.object-parts.index', ['object' => $request->object])
                        ->with('success', __('messages.object-parts.delete.success'));
                }
                return back()->with('error', __('messages.object-parts.delete.fail'));
            } catch (\Throwable $th) {
                report($th);
            }
        }
    }
}