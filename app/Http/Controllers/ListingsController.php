<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingsController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            'lists' => Listings::latest()->filter(request(['tag', 'search']))->paginate(4)
        ]);
    }

    public function show(Listings $listing)
    {
        return view('listings.show', [
            'lists' => $listing
        ]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title'         => 'required',
            'company'       => ['required', Rule::unique('listings', 'company')],
            'location'      => 'required',
            'website'       => 'required',
            'email'         => ['required', 'email'],
            'tags'          => 'required',
            'description'   => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listings::create($formFields);

        return redirect('/')->with('message', 'Listing created susccessfully');
    }

    public function edit(Listings $listing)
    {
        return view('listings.edit', [
            'lists' => $listing
        ]);
    }

    public function update(Request $request, Listings $listing)
    {
        // Make update for a listing by his creator only 
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorised action');
        }

        $formFields = $request->validate([
            'title'         => 'required',
            'company'       => 'required',
            'location'      => 'required',
            'website'       => 'required',
            'email'         => ['required', 'email'],
            'tags'          => 'required',
            'description'   => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return redirect('/')->with('message', 'Listing updated susccessfully');
    }

    public function destroy(Listings $listing)
    {
        // Make delete for a listing by his creator only 
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorised action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    public function manage()
    {
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->get()
        ]);
    }
}
