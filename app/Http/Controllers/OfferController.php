<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer): View
    {
        // Teklifin aktif olup olmadığını kontrol etmek isteyebilirsiniz
        // if (!$offer->is_active) {
        //     abort(404); 
        // }

        // Gelecekte benzer teklifleri veya ilgili ürünleri de gönderebiliriz
        // $relatedOffers = Offer::where('is_active', true)->where('id', '!=', $offer->id)->take(3)->get();

        return view('offers.show', [
            'offer' => $offer,
            // 'relatedOffers' => $relatedOffers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        //
    }
}
