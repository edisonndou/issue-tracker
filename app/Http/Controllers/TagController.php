<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        Tag::create($request->validated());
        return redirect()->route('tags.index')->with('success', 'Tag created!');
    }

    public function show(Tag $tag)
    {
        //
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|unique:tags,name,' . $tag->id . '|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $tag->update($request->validated());
        return redirect()->route('tags.index')->with('success', 'Tag updated!');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted!');
    }
}

