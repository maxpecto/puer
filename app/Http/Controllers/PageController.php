<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $aboutPage = AboutPage::first(); // İlk "Hakkımızda" kaydını al
        // Eğer kayıt bulunamazsa, kullanıcıya bir mesaj göstermek veya boş bir sayfa sunmak isteyebilirsiniz.
        // Şimdilik, eğer $aboutPage null ise view yine de null değişkenle çağrılacak.
        // Blade şablonunda buna göre kontrol ekleyeceğiz.
        return view('pages.about', compact('aboutPage'));
    }
}
