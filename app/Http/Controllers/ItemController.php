<?php

namespace App\Http\Controllers;

use App\Models\Health;
use App\Models\Item;
use App\Models\User;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        $result =  DB::table('USERS')
            ->whereNotNull('name')
            ->whereNotNull('email')
            ->orderBy('id');


        $asd = $result->selectRaw('name, email, "kambing" AS value')->get();

        // $result = DB::table('USERS')->();

        return response()->json($asd, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        //
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): RedirectResponse
    {
        //
    }

    public function addFile(Request $request): JsonResponse
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        $res = Storage::disk('cpanel')->put($fileName, file_get_contents($file));

        return response()->json($res, HttpFoundationResponse::HTTP_OK);
    }

    public function health(Request $request)
    {

        // Log::info($request);
        // $health = Health::create([
        //     "heart_rate" => $request->heart_rate,
        //     "oxygen" => $request->oxygen,
        //     "step" => $request->step,
        //     "fall" => $request->fall,
        //     "stress_level" => $request->stress_level
        // ]);

        return response()->json($request, Response::HTTP_CREATED);
    }

    public function streamPdf(Request $request)
    {

        // dd($request);
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('cert', ["data" => $request->name]);
        return $pdf->stream('invoice.pdf');
    }
}
