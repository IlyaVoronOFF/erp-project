<?php

namespace App\Http\Controllers;

use App\Http\Requests\specialsstore;
use App\Http\Requests\specialsupdate;
use App\Models\Special;
use Illuminate\Http\Request;

class SpecialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spec = Special::select(['id', 'name'])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.speciality.index', ['specList' => $spec]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.speciality.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(specialsstore $request, Special $speciality)
    {
        $data = $request->only(['name']);
        $status = $speciality->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.speciality.index')
                ->with('success', trans('messages.speciality.create.success'));
        }

        return back()->with('error', trans('messages.speciality.create.fail'));
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
    public function edit(Special $speciality)
    {
        return view('pages.speciality.edit', ['specId' => $speciality]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(specialsupdate $request, Special $speciality)
    {
        $data = $request->only(['name']);
        $status = $speciality->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.speciality.index')
                ->with('success', trans('messages.speciality.update.success'));
        }

        return back()->with('error', trans('messages.speciality.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Special $speciality)
    {
        if ($request->ajax()) {
            try {
                $status = $speciality->delete();

                if ($status) {
                    return redirect()->route('pages.speciality.index')
                        ->with('success', __('messages.speciality.delete.success'));
                }
                return back()->with('error', __('messages.speciality.delete.fail'));
            } catch (\Throwable $th) {
                report($th);
            }
        }
    }
}
