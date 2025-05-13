<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail; // Bunu daha sonra yaradacağıq
use App\Settings\GeneralSettings;
use App\Models\ContactSubmission; // Yeni eklenen model
use App\Models\Location; // Location modelini əlavə et

class ContactController extends Controller
{
    public function index(GeneralSettings $settings) // GeneralSettings-i metoda daxil et
    {
        $locations = Location::where('is_active', true)->get();
        $mapboxApiKey = $settings->mapbox_api_key ?? null;
        $mapboxStyleUrl = $settings->mapbox_style_url ?? 'mapbox://styles/mapbox/streets-v12';

        return view('contact.index', [
            'locations' => $locations,
            'mapboxApiKey' => $mapboxApiKey,
            'mapboxStyleUrl' => $mapboxStyleUrl,
        ]);
    }

    public function submit(Request $request, GeneralSettings $settings)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return redirect()->route('contact.index')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', __('Please correct the errors below and try again.'));
        }

        // E-poçt göndərmə hissəsi (hələlik şərhdə saxlanılır və ya sadə bir mesajla əvəz edilir)
        $contactEmail = $settings->contact_form_email ?? config('mail.from.address');

        if (empty($contactEmail)) {
             return redirect()->route('contact.index')
                         ->withInput()
                         ->with('error', __('Message sending is not configured. Please contact support.'));
        }

        try {
            // Mail::to($contactEmail)->send(new ContactFormMail($request->all())); // Daha sonra aktivləşdiriləcək
            
            // Gelen veriyi veritabanına kaydet
            ContactSubmission::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
            ]);

            // Eski loglama kodunu kaldırabilir veya yoruma alabiliriz.
            // logger()->info('New contact form submission:', $request->all());

            return redirect()->route('contact.index')->with('success', __('Your message has been sent successfully! We will get back to you soon.'));

        } catch (\Exception $e) {
            logger()->error('Contact form submission error:', ['error' => $e->getMessage()]);
            return redirect()->route('contact.index')
                        ->withInput()
                        ->with('error', __('An unexpected error occurred while sending your message. Please try again later.'));
        }
    }
}
