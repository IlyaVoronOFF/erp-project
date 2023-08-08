<?php

namespace App\Http\Controllers;

use App\Filters\ObjectFilter;
use App\Http\Requests\objectstore;
use App\Http\Requests\objectsupdate;
use App\Models\ObjectModel;
use App\Models\ObjectParts;
use App\Models\PartUser;
use App\Models\Stage;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ObjectFilter $filters)
    {
        //return $_GET;
        $objects = ObjectModel::filter($filters)
            ->join('stages', 'objects.stage_id', '=', 'stages.id')
            ->select('objects.*', DB::raw('stages.short_name as stage_name'))
            ->get();

        $partsUser = ObjectParts::select('object_parts.*')
            ->where('object_parts.user_id', auth()->user()->id)
            ->get();
        //return $partsUser;

        $parts = ObjectParts::select('object_parts.object_id')
            ->groupBy('object_id')
            ->get();

        $timeParts = DB::table('object_parts')
            ->selectRaw('object_id, sum(time) as sum_times')
            ->groupBy('object_id')
            ->get();
        //return $timeParts;

        $statuses = DB::table('statuses')
            ->select('statuses.*')
            ->get();

        $events = collect([]);
        foreach ($parts as $i) {
            $events[] = PartUser::select('part_user.object_parts_object_id', 'part_user.time')
                ->where('part_user.object_parts_object_id', $i->object_id)
                ->get();
        }

        $timeEvents = collect([]);
        foreach ($events as $i) {
            $timeEvents[] = $i->pipe(function ($i) {
                if ($i->sum('time') && $i->max('object_parts_object_id')) {
                    return collect([
                        'object_id' => $i->max('object_parts_object_id'),
                        'total_time' => $i->sum('time'),
                    ]);
                }
            });
        }

        return view('pages.objects.index', ['objectsList' => $objects, 'partsUser' => $partsUser, 'timeParts' => $timeParts, 'setEvents' => $timeEvents, 'setStatuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stages = Stage::select(['id', 'name'])
            ->orderBy('id', 'asc')
            ->get();
        $users = User::select(['id', 'fio'])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.objects.create', ['stageList' => $stages, 'userList' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(objectstore $request, ObjectModel $object)
    {
        $data = $request->only(['id', 'title', 'code', 'daterange', 'user_id', 'stage_id', 'project_sum', 'plan_fot', 'address', 'description']);
        $status = $object->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.objects.index')
                ->with('success', trans('messages.objects.create.success'));
        }

        return back()->with('error', trans('messages.objects.create.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ObjectModel $object
     * @return \Illuminate\Http\Response
     */
    public function edit(ObjectModel $object)
    {
        $stages = Stage::select(['id', 'name'])
            ->orderBy('id', 'asc')
            ->get();
        $users = User::select(['id', 'fio'])
            ->orderBy('id', 'asc')
            ->get();
        $statuses = Status::select(['id', 'name', 'color'])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.objects.edit', ['objectId' => $object, 'stageList' => $stages, 'userList' => $users, 'statusesList' => $statuses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ObjectModel $object
     * @return \Illuminate\Http\Response
     */
    public function update(objectsupdate $request, ObjectModel $object)
    {
        $data = $request->only(['id', 'title', 'code', 'daterange', 'user_id', 'stage_id', 'project_sum', 'plan_fot', 'address', 'description', 'archive']);
        $status = $object->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.objects.index')
                ->with('success', trans('messages.objects.update.success'));
        }

        return back()->with('error', trans('messages.objects.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ObjectModel $object)
    {
        if ($request->ajax()) {
            try {
                $status = $object->delete();

                if ($status) {
                    return redirect()->route('pages.objects.index')
                        ->with('success', __('messages.objects.delete.success'));
                }
                return back()->with('error', __('messages.objects.delete.fail'));
            } catch (\Throwable $th) {
                report($th);
            }
        }
    }
}