<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Command::with('client')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'required|string|unique:commands,reference',
            'statut' => 'string|max:255',
            'client_id' => 'required|exists:clients,id',
        ]);

        $command = Command::create($validated);
        return response()->json($command, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function show(Command $command)
    {
        return response()->json($command->load(['client', 'produits']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Command $command)
    {
        $validated = $request->validate([
            'reference' => 'sometimes|required|string|unique:commands,reference,' . $command->id,
            'statut' => 'string|max:255',
            'client_id' => 'sometimes|required|exists:clients,id',
        ]);

        $command->update($validated);
        return response()->json($command);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function destroy(Command $command)
    {
        $command->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
