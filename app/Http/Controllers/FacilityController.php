<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    private array $categories = [
        'meeting room', 'theater', 'gym',
        'billiard', 'pingpong', 'communal space', 'band room'
    ];

    public function index()
    {
        $facilities = Facility::latest()->paginate(12);
        return view('facilities.index', compact('facilities'));
    }

    public function create()
    {
        $categories = $this->categories;
        return view('facilities.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:' . implode(',', $this->categories),
            'capacity'    => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        Facility::create($validated);

        return redirect()->route('facilities.index')->with('success', 'Facility created.');
    }

    public function show(Facility $facility)
    {
        return view('facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        $categories = $this->categories;
        return view('facilities.edit', compact('facility', 'categories'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:' . implode(',', $this->categories),
            'capacity'    => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $facility->update($validated);

        return redirect()->route('facilities.index')->with('success', 'Facility updated.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();
        return redirect()->route('facilities.index')->with('success', 'Facility deleted.');
    }
}
