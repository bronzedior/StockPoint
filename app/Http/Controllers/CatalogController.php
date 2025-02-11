<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function showCatalogForm(){
        $catalogs = Catalog::all();
        return view('catalog', compact('catalogs'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|min:5|max:80',
            'price'=>'required',
            'quantity'=>'required',
            'image'=>'required'
        ]);

        $filePath = public_path('storage/images');
        $file = $request->file('image');
        $fileName = $request->title . '-' . $request->author . '-' . $file->getClientOriginalName();
        $file->move($filePath, $fileName);

        Catalog::create([
            'category_id'=>$request->category_name,
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'image'=>$fileName
        ]);

        return redirect(route('admin'));
    }

    public function addItem(){
        $categories = Category::all();
        return view('addItem', compact('categories'));
    }

    public function update(Request $request, $id){
        $catalog = Catalog::findOrFail($id);

        $request->validate([
            'name'=>'required|min:5|max:80',
            'price'=>'required',
            'quantity'=>'required',
            'image'=>'nullable'
        ]);

        $data = [
            'category_id'=>$request->category_name,
            'name'=>$request->name,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
        ];

        if($request->hasFile('image')){
            $filePath = public_path('storage/images');
            $file = $request->file('image');
            $fileName = $request->name . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($filePath, $fileName);

            if($catalog->image && file_exists(public_path('storage/images/' . $catalog->image))){
                unlink(public_path('storage/images/' . $catalog->image));
            }
            $data['image'] = $fileName;
        }

        $catalog->update($data);

        return redirect(route('admin'));
    }

    public function editItem($id){
        $categories = Category::all();
        $catalog = Catalog::findOrFail($id);
        return view('updateItem', compact('categories', 'catalog'));
    }

    public function deleteItem($id){
        Catalog::destroy($id);
        return redirect((route('admin')));
    }
}
