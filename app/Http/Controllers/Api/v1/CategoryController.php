<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;

class CategoryController extends Controller
{
    // Propriedade category usando no construct
    private $category, $totalPage = 10;
    
    // Criado construct para injetar Category automaticamente
    public function __construct(Category $category)
    {   //propriedade $category recebe objeto Category
        $this->category = $category;
    }

    public function index(Category $category, Request $request)
    {
        $categories = $this->category->getResults($request->name);

        return response()->json($categories, 200);
    }

    public function show($id)
    {
        $category = $this->category->find($id);
        if(!$category)
            return response()->json(['error' => 'Not found'], 404);
        
        return response()->json($category, 200);
    }

    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());

        return response()->json($category, 201);
    }

    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        $category = $this->category->find($id);
        if(!$category)
            return response()->json(['error' => 'Not found'], 404);

        $category->update($request->all());

        return response()->json($category);
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category)
            return response()->json(['error' => 'Not found'], 404);

        $category->delete();
        
        return response()->json(['success' => true], 204);
    }

    // Método de RELACIONAMENTO Category -> Product
    public function products($id)
    {   // Recupera Categoria pelo seu ID
        $category = $this->category->find($id);
        if(!$category)
            return response()->json(['error' => 'Not found'], 404);

        // Recupera Produtos. Método productsCategory() é o mesmo criado na model Category.
        $products = $category->productsCategory()->paginate($this->totalPage);        
        
        // Retorna produtos e categorias
        return response()->json([
            'category' => $category,
            'products' => $products,
        ]);
    }
}
