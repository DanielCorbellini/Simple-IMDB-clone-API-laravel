<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StreamPlatform;
use App\Services\StreamPlatformService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class StreamPlatformController extends Controller
{
    protected $streamPlatformService;

    public function __construct(StreamPlatformService $streamPlatformService)
    {
        $this->streamPlatformService = $streamPlatformService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $streamPlatforms = $this->streamPlatformService->getStreamPlatformFromDatabase();
        return response()->json($streamPlatforms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'about' => 'required|string|max:150',
            'website' => 'required|string|max:100'
        ]);

        try {
            $platform = $this->streamPlatformService->createStreamPlatform($validatedData);
            return response()->json($platform, 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Falha ao salvar no banco de dados.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stream = $this->streamPlatformService->getSpecificStreamPlatform($id);

        if (!$stream) return response()->json(['message' => 'Item não encontrado'], 404);

        return response()->json($stream);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StreamPlatform $streamPlatform)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'about' => 'required|string|max:150',
            'website' => 'required|string|max:100'
        ]);

        $updatedPlatform = $this->streamPlatformService->updateStreamPlatform($streamPlatform, $validatedData);

        return response()->json([
            "message" => 'Stream platform updated!',
            'streamPlatform' => $updatedPlatform
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $streamPlatform = $this->streamPlatformService->deleteStreamPlatform($id);

        if (!$streamPlatform) return response()->json(['message' => 'Item não encontrado'], 404);

        return response()->json(['message' => 'Item deletado com sucesso.', 200]);
    }
}
