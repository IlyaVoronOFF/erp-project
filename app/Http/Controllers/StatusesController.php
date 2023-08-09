<?php

namespace App\Http\Controllers;

use App\Http\Requests\statusesstore;
use App\Http\Requests\statusesupdate;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::select(['id', 'name', 'color'])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.statuses.index', ['statusesList' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(statusesstore $request, Status $status)
    {
        $data = $request->only(['name', 'color']);
        $flag = $status->fill($data)->save();

        if ($flag) {
            return redirect()->route('pages.statuses.index')
                ->with('success', trans('messages.statuses.create.success'));
        }

        return back()->with('error', trans('messages.statuses.create.fail'));
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
    public function edit(Status $status)
    {
        return view('pages.statuses.edit', ['statusId' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(statusesupdate $request, Status $status)
    {
        $data = $request->only(['name', 'color']);
        $flag = $status->fill($data)->save();

        if ($flag) {
            return redirect()->route('pages.statuses.index')
                ->with('success', trans('messages.statuses.update.success'));
        }

        return back()->with('error', trans('messages.statuses.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Status $status)
    {
        if ($request->ajax()) {
            try {
                $flag = $status->delete();

                if ($flag) {
                    return redirect()->route('pages.statuses.index')
                        ->with('success', __('messages.statuses.delete.success'));
                }
                return back()->with('error', __('messages.statuses.delete.fail'));
            } catch (\Throwable $th) {
                report($th);
            }
        }
    }
}
