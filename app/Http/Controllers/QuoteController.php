<?php

namespace App\Http\Controllers;

use App\Mail\QuoteReceived;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        // Honeypot: bots fill the hidden field; pretend success.
        if ($request->filled('website')) {
            return back()->with('status', 'Thank you. We will be in touch soon.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:120',
            'contact' => 'required|string|max:160',
            'service' => 'nullable|string|max:160',
            'message' => 'nullable|string|max:3000',
        ]);

        $quote = QuoteRequest::create($data + ['ip' => $request->ip()]);

        try {
            Mail::to(config('epis.emails'))->send(new QuoteReceived($quote));
        } catch (\Throwable $e) {
            Log::warning('Quote email failed: '.$e->getMessage());
        }

        return redirect(route('home').'#quote')->with('status', 'Thank you. We will be in touch soon.');
    }
}
