<?php

namespace App\Http\Controllers;

use App\Http\Requests\clientsstore;
use App\Http\Requests\clientsupdate;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::select(['id', 'name', 'email', 'phone', 'address', 'description'])
            ->orderBy('id', 'asc')
            ->get();

        return view('pages.clients.index', ['clientsList' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(clientsstore $request, Client $client)
    {
        $data = $request->only(['name', 'email', 'phone', 'address', 'description']);
        $status = $client->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.clients.index')
                ->with('success', trans('messages.clients.create.success'));
        }

        return back()->with('error', trans('messages.clients.create.fail'));
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
    public function edit(Client $client)
    {
        return view('pages.clients.edit', ['clientId' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(clientsupdate $request, Client $client)
    {
        $data = $request->only(['name', 'email', 'phone', 'address', 'description']);
        $status = $client->fill($data)->save();

        if ($status) {
            return redirect()->route('pages.clients.index')
                ->with('success', trans('messages.clients.update.success'));
        }

        return back()->with('error', trans('messages.clients.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Client $client)
    {
        if ($request->ajax()) {
            try {
                $status = $client->delete();

                if ($status) {
                    return redirect()->route('pages.client.index')
                        ->with('success', __('messages.client.delete.success'));
                }
                return back()->with('error', __('messages.client.delete.fail'));
            } catch (\Throwable $th) {
                report($th);
            }
        }
    }
}
