<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Element;
use Illuminate\Http\Request;

class GenshinImpactController extends Controller
{
    public function index(Request $request)
    {
        $element = $request->query('element', 'all');
        $rarity = $request->query('rarity', 'all');

        $query = Character::with('element');

        if ($element !== 'all' && $element !== '') {
            $query->where('element_id', $element);
        }

        if ($rarity !== 'all' && $rarity !== '') {
            $query->where('rarity', $rarity);
        }

        $characters = $query->get();
        $elements = Element::all();

        return view('characters.index', [
            'characters' => $characters,
            'elements' => $elements,
            'element' => $element,
            'rarity' => $rarity,
        ]);
    }

    public function create()
    {
        $elements = Element::all();

        return view('characters.create', compact('elements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'element_id' => 'required|exists:elements,id',
            'weapon' => 'required|in:Sword,Claymore,Polearm,Catalyst,Bow',
            'rarity' => 'required|numeric|in:4,5',
            'is_playable' => 'required|boolean',
            'remarks' => 'nullable',
        ]);

        Character::create($validated);

        return redirect()
            ->route('characters.index')
            ->with('success', 'Character added successfully.');
    }

    public function show(Character $character)
    {
        return view('characters.show', compact('character'));
    }

    public function edit(Character $character)
    {
        $elements = Element::all();

        return view('characters.edit', compact('character', 'elements'));
    }

    public function update(Request $request, Character $character)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'element_id' => 'required|exists:elements,id',
            'weapon' => 'required|in:Sword,Claymore,Polearm,Catalyst,Bow',
            'rarity' => 'required|numeric|in:4,5',
            'is_playable' => 'required|boolean',
            'remarks' => 'nullable',
        ]);

        $character->update($validated);

        return redirect()->route('characters.index');
    }

    public function destroy(Character $character)
    {
        $character->delete();

        return redirect()->route('characters.index');
    }

    public function featured()
    {
        $character = Character::with('element')->findOrFail(4);

        return view('characters.featured', compact('character'));
    }
}
