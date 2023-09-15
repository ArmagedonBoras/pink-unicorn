<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class PageController extends Controller
{
    protected $rules = [
        'title' => 'string',
        'tagline' => 'string|nullable',
        'title_image' => 'string|nullable',
        'title_size' => 'integer',
        'body' => 'string',
        'body_edit' => 'string',
        'active' => 'bool',
        'name' => 'string',
        'link' => 'string',
        'gate' => 'string|nullable',
        'sort_order' => 'number',
        'parent' => 'string|nullable',
    ];

    protected $page_rules = [
        'title' => 'string',
        'title_color' => 'string',
        'tagline' => 'string|nullable',
        'tagline_color' => 'string',
        'title_image' => 'string|nullable',
        'title_size' => 'integer',
        'body' => 'string',
        'active' => 'bool',
    ];

    protected $menu_rules = [
        'name' => 'string',
        'link' => 'string',
        'gate' => 'string|nullable',
        'sort_order' => 'number',
        'parent' => 'string|nullable',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('update', Page::class);
        $items = Page::all();
        $pages = [];
        foreach ($items as $page) {
            $page->title_link = $page->link;
            $page->edit_link = route('pages.edit', $page);
            $page->edit = icon('pencil-square');
            $pages[] = $page;
        }
        $fields = ['title', 'edit', 'link', 'gate', 'active_text'];
        return view('pages.index', compact('fields', 'pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('update', Page::class);
        $image_list = Storage::disk('public')->allFiles('bg-images');
        $images = ['' => 'Ingen bild'];
        foreach ($image_list as $key => $image) {
            $images["storage/".$image] = basename($image);
        }
        $menu = new Menu();
        $page = new Page();
        return view('pages.edit', compact('page', 'images', 'menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('update', Page::class);
        $valid = $request->validate($this->rules);
        $page = Page::create($valid);
        $menu = Menu::create($valid);
        $page->menu()->save($menu);
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response

    * public function show(Page $page)
    * {
    *     abort_unless($page->menu->isAuthorized(), 403);
    *     return view('pages.show', ['page' => $page]);
    * }
    */

    public function show($link)
    {
        return $this->showParent('', $link);
    }

    public function showParent(string $parent, $link)
    {
        $menu = Menu::where('parent', $parent)->where('link', $link)->first();
        abort_if(empty($menu), 404);
        abort_if(empty($menu->page), 404);
        abort_if(!$menu->page->active, 404);
        abort_unless($menu->isAuthorized(), 403);
        return view('pages.show', ['page' => $menu->page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $this->authorize('update', $page);
        $image_list = Storage::disk('public')->allFiles('bg-images');
        $images = ['' => 'Ingen bild'];
        foreach ($image_list as $key => $image) {
            $images["storage/".$image] = basename($image);
        }
        $parents = Menu::getParents();
        $parents[''] = 'Ingen överstående länk';
        $menu = $page->menu;
        return view('pages.edit', compact('page', 'images', 'parents', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $this->authorize('update', $page);
        // $valid = $request->validate($this->rules);
        $validated_page = $request->validate($this->page_rules);
        $validated_menu = $request->validate($this->menu_rules);
        $page->update($validated_page);
        $page->save();

        $validated_menu['gate'] = $validated_menu['gate'] ?? '';
        $validated_menu['parent'] = $validated_menu['parent'] ?? '';
        $page->menu->update($validated_menu);
        $page->menu->save();
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
