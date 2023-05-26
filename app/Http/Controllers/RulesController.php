<?php

namespace App\Http\Controllers;

use App\Http\Requests\rulesstore;
use App\Http\Requests\rulesupdate;
use App\Models\Rule;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rules = Rule::select(['id', 'name'])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.rules.index', ['rulesList' => $rules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.rules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(rulesstore $request, Rule $rule)
    {
        $data = $request->only(['name']);
        $status = $rule->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.rules.index')
                ->with('success', trans('messages.rules.create.success'));
        }

        return back()->with('error', trans('messages.rules.create.fail'));
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
    public function edit(Rule $rule)
    {
        return view('pages.rules.edit', ['ruleId' => $rule]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(rulesupdate $request, Rule $rule)
    {
        $data = $request->only(['name']);
        $status = $rule->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.rules.index')
                ->with('success', trans('messages.rules.update.success'));
        }

        return back()->with('error', trans('messages.rules.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Rule $rule)
    {
        if ($request->ajax()) {
            try {
                $status = $rule->delete();

                if ($status) {
                    return redirect()->route('pages.rules.index')
                        ->with('success', __('messages.rules.delete.success'));
                }
                return back()->with('error', __('messages.rules.delete.fail'));
            } catch (\Throwable $th) {
                report($th);
            }
        }
    }
}
