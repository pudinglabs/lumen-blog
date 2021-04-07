<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $repo;

    public function __construct(CategoryRepository $repo)
    {
        $this->middleware('auth');
        $this->repo = $repo;
    }

    public function index()
    {
        return response()->json($this->repo->all());
    }

    public function show($id)
    {
        return response()->json($this->repo->find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
        ]);

        $this->repo->create($request->only($this->repo->getModel()->fillable));

        return response()->json(['Category successfully created!'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
        ]);

        $this->repo->update($request->only($this->repo->getModel()->fillable), $id);

        return response()->json(['Category successfully updated!'], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $this->repo->delete($id);

        return response()->json(['Category sucessfully deleted!'], Response::HTTP_OK);
    }
}
