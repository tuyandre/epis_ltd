<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function index()
    {
        return view('admin.quotes.index', ['quotes' => QuoteRequest::latest()->paginate(20)]);
    }

    public function show(QuoteRequest $quote)
    {
        if ($quote->status === 'new') {
            $quote->update(['status' => 'read']);
        }

        return view('admin.quotes.show', compact('quote'));
    }

    public function update(Request $request, QuoteRequest $quote)
    {
        $quote->update($request->validate(['status' => 'required|in:new,read,replied,closed']));

        return back()->with('status', 'Status updated.');
    }

    public function destroy(QuoteRequest $quote)
    {
        $quote->delete();

        return redirect()->route('admin.quotes.index')->with('status', 'Request deleted.');
    }
}
