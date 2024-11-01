<?php

namespace App\Http\Controllers;

use App\Exports\ItemsExport;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('category')->paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->slug = Str::slug($request->name);
        $item->description = $request->description;
        $item->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $item->image = $name;
        }
        $item->save();
        if ($item) {
            return redirect()->route('items.index')
                ->with('success', 'Item created successfully.');
        }
        else {
            return redirect()->route('items.create')
                ->old()->with('error', 'Item creation failed.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $item = Item::with('category')->find($item->id);
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->slug = $request->slug;
        $item->description = $request->description;
        $item->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $item->image = $name;
        }
        $item->save();
        if ($item) {
            return redirect()->route('items.index')
                ->with('success', 'Item created successfully.');
        }
        else {
            return redirect()->route('items.create')
                ->old()->with('error', 'Item creation failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        if ($item->image) {
            $image_path = public_path('/images/') . $item->image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $item->delete();
        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully');
    }

    public function export()
    {
        return Excel::download(new ItemsExport(), 'items.xlsx');
    }

}
