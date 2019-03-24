<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    private $rulesValidator = [
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'photo' => 'required|mimes:jpeg,jpg,png',
            'role' => 'required|string',
    ];
    private $rulesValidatorUpdate = [
            'name'     => 'string',
            'email'    => 'string|email|unique:users',
            'password' => 'string|confirmed',
            'photo' => 'mimes:jpeg,jpg,png',
            'role' => 'string',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:admin']);
    }


    public function index()
    {
        
        $users = User::with('roles')->get();

        return response()->json(["users" => $users, "status" => 200]);
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
    
        $validator = Validator::make($request->all(), $this->rulesValidator);

        if ($validator->fails()) {
            return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        } 
        else {

            $image = $request->file('photo')->store('avatars');
            $user = new User([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
                'photo' => 'storage/'. $image,
            ]);

            $user->assignRole($request->role);
            $user->save();

            return back()->with('status', '¡Articulo guardado!');
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::whereId($id)->with('roles')->first();
        $roles = Role::all();

        return response()->json(["user" => $user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(["request" => $request->all()]);
        
        $validator = Validator::make($request->all(), $this->rulesValidatorUpdate);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()->all()]);
        } 
        else {

            if ($request->file('photo') != null) {
                $image = $request->file('photo')->store('avatars');
                $request->photo = 'storage/'. $image;
            }

            $user = User::findOrFail($id);  
            if (! is_null($request->password)) {
                $request->password = bcrypt($request->password);
            }
            
            
            
            $user->update($request->all());
            $user->syncRoles([$request->role]);
        
            return response()->json(["status" => 'Se actualizò el usuario']);
        }

    }

    public function delete($id)
    {   
        $user = User::find($id);
        
        if (! is_null($user)) {
            $user->roles()->detach();
            $user->delete();

            return response()->json(["status" => 200]);
        }

        return response()->json(["status" => 404]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
