<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Models\NavigationType;
use App\Models\NavigationChild;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent_pages = Navigation::with('children')->where('navigation_type_id', 1)->orderBy('order_column', 'asc')->get();
        $admin_parent_pages = Navigation::with('children')->where('navigation_type_id', 2)->orderBy('order_column', 'asc')->get();
        $navigation_types = NavigationType::all();
        return view('admin.navigation', ['parent_pages' => $parent_pages, 'admin_pages' => $admin_parent_pages, 'navigation_types' => $navigation_types]);
    }

    public function getTable(Request $request)
    {
        $parent_pages = Navigation::with('children')->where('navigation_type_id', $request->id)->orderBy('order_column', 'asc')->get();
        return view('admin.navtable', ['parent_pages' => $parent_pages]);
    }

    public function order($type, $direction, $id)
    {
        if ($type == "parent") {
            $link = Navigation::find($id);
            $nav_type = NavigationType::find($link->navigation_type_id);
        } elseif ($type == "child") {
            $link = NavigationChild::find($id);
            $nav_type = NavigationType::find($link->parent->navigation_type_id);
        }
        if ($link) {
            if ($direction == "up") {
                try {
                    $link->moveOrderUp();
                    return response()->json([
                        'success' => true,
                        'type' => $nav_type->slug,
                        'type_id' => $nav_type->id
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'error' => $e
                    ]);
                }
            } elseif ($direction == "down") {
                try {
                    $link->moveOrderDown();
                    return response()->json([
                        'success' => true,
                        'type' => $nav_type->slug,
                        'type_id' => $nav_type->id
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'error' => $e
                    ]);
                }
            }
            return response()->json([
                'success' => false,
                'error' => "Direction not valid."
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => "Type not valid."
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'icon' => 'nullable',
            'user_level' => 'required',
            'parent' => 'nullable',
            'nav_type' => 'required'
        ]);

        try {
            if (!$request->get('parent')) {
                $page = new Navigation([
                    'title' => $request->get('title'),
                    'url'=> $request->get('url'),
                    'icon'=> $request->get('icon'),
                    'user_level'=> $request->get('user_level'),
                    'navigation_type_id'=> $request->get('nav_type'),
                ]);
                $page->save();
                $nav_type = NavigationType::find($page->navigation_type_id)->slug;
                $type_id = $page->navigation_type_id;
                return response()->json([
                    'success' => true,
                    'type' => $nav_type,
                    'type_id' => $type_id
                ]);
            } else {
                $page = new NavigationChild([
                    'title' => $request->get('title'),
                    'url'=> $request->get('url'),
                    'user_level'=> $request->get('user_level'),
                    'navigation_id'=> $request->get('parent'),
                ]);
                $page->save();
                $nav_type = NavigationType::find($page->parent->navigation_type_id)->slug;
                $type_id = $page->parent->navigation_type_id;
                return response()->json([
                    'success' => true,
                    'type' => $nav_type,
                    'type_id' => $type_id
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function show(Navigation $navigation)
    {
        $array = $navigation->toArray();
        $array['type'] = "parent";
        return response()->json($array);
    }

    public function showChild(NavigationChild $navigation)
    {
        $array = $navigation->toArray();
        $array['type'] = "child";
        return response()->json($array);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function edit(Navigation $navigation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Navigation $navigation)
    {
        $request->validate([
            'edit_title' => 'required',
            'edit_url' => 'required',
            'edit_icon' => 'nullable',
            'edit_user_level' => 'required',
        ]);
        $nav_type = NavigationType::find($navigation->navigation_type_id);
        try {
            $navigation->title = $request->get('edit_title');
            $navigation->url = $request->get('edit_url');
            $navigation->icon = $request->get('edit_icon');
            $navigation->user_level = $request->get('edit_user_level');
            $navigation->save();
            return response()->json(['success' => true, 'type' => $nav_type->slug, 'type_id' => $nav_type->id]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function updateChild(Request $request, NavigationChild $navigation)
    {
        $request->validate([
            'edit_child_title' => 'required',
            'edit_child_url' => 'required',
            'edit_child_user_level' => 'required',
        ]);
        $nav_type = NavigationType::find($navigation->parent->navigation_type_id);

        try {
            $navigation->title = $request->get('edit_child_title');
            $navigation->url = $request->get('edit_child_url');
            $navigation->user_level = $request->get('edit_child_user_level');
            $navigation->save();
            return response()->json(['success' => true, 'type' => $nav_type->slug, 'type_id' => $nav_type->id]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Navigation $navigation)
    {
        $nav_type = NavigationType::find($navigation->navigation_type_id);
        try {
            $navigation->delete();
            return response()->json(['success' => true, 'type' => $nav_type->slug, 'type_id' => $nav_type->id]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e]);
        }
    }
    public function destroyChild($id)
    {
        $navigation = NavigationChild::find($id);
        $nav_type = NavigationType::find($navigation->parent->navigation_type_id);
        try {
            $navigation->delete();
            return response()->json(['success' => true, 'type' => $nav_type->slug, 'type_id' => $nav_type->id]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e]);
        }
    }
}
