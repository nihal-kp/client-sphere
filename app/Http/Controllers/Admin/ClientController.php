<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use App\Enums\UserType;
use App\Enums\UserStatus;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Traits\HandlesUserUpdate;

class ClientController extends Controller
{
    use HandlesUserUpdate;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables)
    {
        if($request->ajax()){
        
            $query = User::where('type', UserType::CLIENT->value)->select('name', 'email', 'image', 'status', 'created_at', 'id')->orderBy('id','DESC');
     
            return $dataTables->eloquent($query)
            ->editColumn('image', function (User $client) {
                $imageUrl = $client->image 
                    ? asset('uploads/clients/' . $client->image) 
                    : asset('images/blank-image.jpg');
                return '<img src="' . $imageUrl . '" width="50" height="50" class="img-thumbnail" />';
            })
            ->editColumn('status', function (User $client) {
                if ($client->status === UserStatus::INACTIVE) {
                    return '<span class="font-weight-bold text-danger">' . UserStatus::INACTIVE->label() . '</span>';
                }

                return '<span class="font-weight-bold text-success">' . UserStatus::ACTIVE->label() . '</span>';
            })
            ->addColumn('actions', function (User $client) {
                return
                    '<a href="' . route('admin.clients.show', $client) . '" class="btn btn-sm" title="View"><i class="fa fa-eye"></i></a> ' .
                    '<a href="' . route('admin.clients.edit', $client) . '" class="btn btn-sm" title="Edit"><i class="fa fa-edit"></i></a> ' .
                    '<a data-toggle="modal" href="#delete-client-modal" data-href="' . route('admin.clients.destroy', $client) . '" class="btn btn-sm client-delete" title="Delete"><i class="fa fa-trash"></i></a>';
            })      
           ->rawColumns(['image','status','actions'])
           ->make(true);
        }
        return view('admin.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = new User();
        return view('admin.clients.form', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/clients'), $fileName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $fileName,
            'type' => UserType::CLIENT->value,
            'status' => UserStatus::from($request->status),
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $client)
    {
        return view('admin.clients.form', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $client)
    {
        $this->handleUpdate($client, $request);

        return redirect()->route('admin.clients.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $client)
    {
        $client->delete();

        return response()->json(['status'=>'success', 'message'=>'Data deleted successfully!']);
    }
}
