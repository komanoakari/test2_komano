<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use App\Models\ProductSeason;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $products = Product::with('seasons')->paginate(6);
        $seasons = Season::all();
        return view('index', compact('products', 'seasons'));
    }

    public function add()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function create(ContactRequest $request)
    {
        if ($request->has('back')) {
            return redirect('/products');
        }

        $product = Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'image' => $request->file('image')->store('images', 'public'),
                'description'=> $request->input('description'),
        ]);
        
        $product->seasons()->attach($request->input('season_id'));

        return redirect('/products');
    }

    public function edit($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();
        return view('edit', compact('product','seasons'));
    }

    public function update(UpdateRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $form = $request->all();
        unset($form['_token']);
        unset($form['_method']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $form['image'] = $imagePath;
        } else {
            $form['image'] = $product->image;

        }
        $product->update($form);

        if (isset($form['season_id'])) {
            $product->seasons()->sync($form['season_id']);
        }
        return redirect('/products');
    }

    public function destroy(Request $request, $productId)
    {
        $product = Product::find($productId);

        $product->seasons()->detach();

        $product->delete();
        return redirect('/products');
    }

    public function search(Request $request)
    {
        $query = Product::query();
        $query = $this->getSearchQuery($request, $query);

        if ($request->filled('sort')) {
            if($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            }
        }
        $products = $query->paginate(6)->appends($request->all());

        return view('index', compact('products'));
    }


    private function getSearchQuery($request, $query)
    {
        if(!empty($request->keyword)) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'. $request->keyword . '%');
            });
        }
        return $query;
    }
}
