<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Filters\TagFilters;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $validations;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(('can:tags-update'));
        $this->validations = [
            'name' => ['required', 'max:255', 'regex:/^[a-z0-9.-_åäö]+$/'],
            'label' => ['required', 'max:255'],
            'type' => ['required', 'regex:/^[a-z0-9.-_]+$/'],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagFilters $tagFilters)
    {
        $tags = [];
        $tagList = Tag::where('id', '>', 0)->filter($tagFilters)->get();
        foreach($tagList as $tag) {
            if (Str::contains($tag->type, '.')) {
                $tags[Str::beforeLast($tag->type, '.')][Str::afterLast($tag->type, '.')][] = $tag;
            } else {
                $tags['Övriga'][$tag->type][] = $tag;
            }
        }
        return view('tags.index', ['groupedTags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $types = [];
        $typeList = Tag::typeNames();
        foreach($typeList as $type) {
            $types[Str::ucfirst(Str::beforeLast($type, '.'))][$type] = Str::afterLast($type, '.');
        }
        $preselected = $request->input('type') ?? '';
        return view('tags.create', ['preselected' => $preselected, 'types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validations);
        Tag::create($validated);
        return redirect(route('tags.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag, Request $request)
    {
        $types = [];
        $typeList = Tag::typeNames();
        foreach($typeList as $type) {
            $types[Str::ucfirst(Str::beforeLast($type, '.'))][$type] = Str::afterLast($type, '.');
        }
        return view('tags.edit', ['types' => $types, 'tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        if ($tag->protected) {
            unset($this->validations['name']);
            unset($this->validations['type']);
        }
        $validated = $request->validate($this->validations);
        $tag->update($validated);
        $tag->save();
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect(route('tags.index'));
    }

}
