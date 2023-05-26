<?php

namespace App\Http\Controllers;

use App\Http\Requests\stagesstore;
use App\Http\Requests\stagesupdate;
use App\Models\Stage;
use Illuminate\Http\Request;

class StagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stages = Stage::select(['id', 'name', 'short_name'])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.stages.index', ['stagesList' => $stages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.stages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(stagesstore $request, Stage $stage)
    {
        $data = $request->only(['name', 'short_name']);
        $status = $stage->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.stages.index')
                ->with('success', trans('messages.stages.create.success'));
        }

        return back()->with('error', trans('messages.stages.create.fail'));
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
    public function edit(Stage $stage)
    {
        return view('pages.stages.edit', ['stageId' => $stage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(stagesupdate $request, Stage $stage)
    {
        $data = $request->only(['name', 'short_name']);
        $status = $stage->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.stages.index')
                ->with('success', trans('messages.stages.update.success'));
        }

        return back()->with('error', trans('messages.stages.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Stage $stage)
    {
        if ($request->ajax()) {
            try {
                $status = $stage->delete();

                if ($status) {
                    return redirect()->route('pages.stages.index')
                        ->with('success', __('messages.stages.delete.success'));
                }
                return back()->with('error', __('messages.stages.delete.fail'));
            } catch (\Throwable $th) {
                report($th);
            }
        }
    }
}
