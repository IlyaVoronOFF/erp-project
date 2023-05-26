<?php

namespace App\Http\Controllers;

use App\Http\Requests\partsstore;
use App\Http\Requests\partsupdate;
use App\Models\Part;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parts = Part::select(['id', 'name', 'short_name'])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.parts.index', ['partsList' => $parts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.parts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(partsstore $request, Part $part)
    {
        $data = $request->only(['name', 'short_name']);
        $status = $part->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.parts.index')
                ->with('success', trans('messages.parts.create.success'));
        }

        return back()->with('error', trans('messages.parts.create.fail'));
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
    public function edit(Part $part)
    {
        return view('pages.parts.edit', ['partId' => $part]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(partsupdate $request, Part $part)
    {
        $data = $request->only(['name', 'short_name']);
        $status = $part->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.parts.index')
                ->with('success', trans('messages.parts.update.success'));
        }

        return back()->with('error', trans('messages.parts.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Part $part)
    {
        if ($request->ajax()) {
            try {
                $status = $part->delete();

                if ($status) {
                    return redirect()->route('pages.parts.index')
                        ->with('success', __('messages.parts.delete.success'));
                }
                return back()->with('error', __('messages.parts.delete.fail'));
            } catch (\Throwable $th) {
                report($th);
            }
        }
    }
}
