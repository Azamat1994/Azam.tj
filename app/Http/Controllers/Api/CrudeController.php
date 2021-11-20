<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CrudeRequest;
use App\Http\Requests\CrudeUpdateApiRequest;
use App\Models\Crude;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CrudeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Crude::get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crude.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudeRequest $request)
    {
        $crud = $request->all();
        try{
            $image = $crud['image'];
            $pos  = strpos($image, ';');
            $type = explode(':', substr($image, 0, $pos))[1];
            $type1 = substr($type, 6, strlen($type));
            $imageName = date('Y-m-d_H-i-s').'_'.Str::random(10) . '.' . $type1;
            $image = str_replace('data:image/' . $type1 . ';base64,', '', $image);

            Storage::disk('crude')->put($imageName, base64_decode($image));
            $path = 'images/crude/' . $imageName;
            $crud['image']=$path;
        }catch(\Exception $ex){
            $path= "";
        }

        $crude = Crude::create($crud);
        return response()->json($crude, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crude = Crude::find($id);
        if(is_null($crude)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        return response()->json($crude, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $crude = Crude::find($id);
//        return view('crudes.edit', compact('crude'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrudeUpdateApiRequest $request, $id)
    {
        $crude = Crude::find($id);
        if(is_null($crude)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        $crud = $request->all();
        try{
            $image = $crud['image'];
            $pos  = strpos($image, ';');
            $type = explode(':', substr($image, 0, $pos))[1];
            $type1 = substr($type, 6, strlen($type));
            $imageName = date('Y-m-d_H-i-s').'_'.Str::random(10) . '.' . $type1;
            $image = str_replace('data:image/' . $type1 . ';base64,', '', $image);

            Storage::disk('crude')->put($imageName, base64_decode($image));
            $path = 'images/crude/' . $imageName;
            $crud['image']=$path;
        }catch(\Exception $ex){
//            $path= "";
        }
        $crude->update($crud);
        return response()->json($crude, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crude = Crude::find($id);
        if(is_null($crude)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        $crude->delete();
        return response()->json(null, 204);
    }

    function search($name)
    {
        $data = Crude::where('name', 'like', '%'.$name.'%')->get();
        if(is_null($data)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        return response()->json($data, 200);
    }
}
