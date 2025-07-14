<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TextBox;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TextBoxRequest;

class TextBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables)
    {
        if($request->ajax()){
        
            $query = TextBox::select('label', 'value', 'created_at', 'id')->orderBy('id','DESC');
     
            return $dataTables->eloquent($query)
            ->addColumn('actions', function (TextBox $textBox) {
                return
                    '<a href="' . route('admin.text-boxes.show', $textBox) . '" class="btn btn-sm" title="View"><i class="fa fa-eye"></i></a> ' .
                    '<a href="' . route('admin.text-boxes.edit', $textBox) . '" class="btn btn-sm" title="Edit"><i class="fa fa-edit"></i></a> ' .
                    '<a data-toggle="modal" href="#delete-textBox-modal" data-href="' . route('admin.text-boxes.destroy', $textBox) . '" class="btn btn-sm textBox-delete" title="Delete"><i class="fa fa-trash"></i></a>';
            })      
           ->rawColumns(['image','status','actions'])
           ->make(true);
        }
        return view('admin.text-boxes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $textBox = new TextBox();
        return view('admin.text-boxes.form', compact('textBox'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TextBoxRequest $request)
    {
        DB::beginTransaction();

        try {
            $textBox = TextBox::create($request->only('label', 'value'));
            $textBox->users()->sync($request->clients);

            DB::commit();

            return redirect()->route('admin.text-boxes.index')->with('success', 'Data added successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(['error' => 'An error occurred while creating the text box.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TextBoxRequest $request)
    {
        $textBox->load('users');
        return view('admin.text-boxes.show', compact('textBox'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TextBox $textBox)
    {
        $textBox->load('users');
        $selectedClients = $textBox->users->pluck('id')->toArray();

        return view('admin.text-boxes.form', compact('textBox', 'selectedClients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TextBox $textBox)
    {
        DB::beginTransaction();
        try {
            $textBox->update($request->only('label', 'value'));
            $textBox->users()->sync($request->clients);
            DB::commit();

            return redirect()->route('admin.text-boxes.index')->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => 'An error occurred while creating the text box.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TextBox $textBox)
    {
        try {
            $textBox->delete();
            return response()->json(['status' => 'success', 'message' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to delete text box'], 500);
        }
    }
}
