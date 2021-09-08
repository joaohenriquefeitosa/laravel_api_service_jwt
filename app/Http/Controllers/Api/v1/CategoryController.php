<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    private $category;
    private $total_page = 10;

    public function __construct(Category $category)
    {
        $this->category = $category;    
    }

    public function index(Request $request)
    {
        $category = $this->category->getResults($request->name);
        
        return response()->json($category);
    }

    public function show($id)
    {
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($category);
    }

    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());
        return response()->json($category, 201);
    }

    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);
        
        $category->update($request->all());
        
        return response()->json($category);
    }

    public function delete($id)
    {
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);

        $category->delete();

        return response()->json([], 204);
    }

    public function products($id)
    {
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);
        
        $products = $category->products()->paginate($this->total_page);
        return response()->json([
            'category' => $category,
            'products' => $products
        ]);
    }
}
