<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function add(){
        return view('categories.create');
    }
    public function create() {
        $validator = validator(request()->all(), [
            'name' => 'required|max:50',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $category = new Category;
        $category->name = request()->name;
        $category->save();
        return redirect('/categories/list');
    }
    public function list() {
        $data = Category::all();
        return view('categories.list', [
            'categories' => $data
        ]);
    }
    public function edit($id) {
        $category = Category::find($id);
        return view('categories.edit', [
            'cate' => $category
        ]);
    }
    public function update($id) {
        $validator = validator(request()->all(), [
            'name' => 'required|max:50',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $category = Category::find($id);
        $category->name = request()->name;
        $category->save();
        return redirect('/categories/list');
    }
    public function delete($id) {
        $dt = new DateTime();
        $category = Category::find($id);
        $category->deleted_at = $dt;
        $category->save();
        return redirect('/categories/list');
    }
}
