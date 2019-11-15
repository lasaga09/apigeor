<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Validator;

class ProductoController extends Controller
{

  public  $sms = "Registrado correctamente!!!";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rs = Producto::all();
        return response()->json(['success'=>$rs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [ 
        'producto' => 'required', 
        'descripcion' => 'required', 
        'precio' => 'required', 
        'stock' => 'required', 
        ]);


        if ($validator->fails()) { 
        return response()->json(['error' =>$validator->errors()], 401);            
        }

         $input =  $request->all();
          $productos = Producto::create($input);
        return response()->json(['success'=>$productos]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rs=Producto::find($id);
        return response()->json(['success'=>$rs]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [ 
        'producto' => 'required', 
        'descripcion' => 'required', 
        'precio' => 'required', 
        'stock' => 'required', 
        ]);

        if ($validator->fails()) { 
        return response()->json(['error' =>$validator->errors()], 401);            
        }

        $input =$request->all();
        
       $productos=producto::find($id);
       $productos->descripcion=$input["descripcion"];
       $productos->producto=$input["producto"];
       $productos->precio=$input["precio"];
       $productos->stock=$input["stock"];
       $productos->save();
       return response()->json(['success'=>$productos]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productos=Producto::find($id);
       if($productos == ''){

       return response()->json(['error'=>'Producto no encontrado']);
       }

        $productos->delete();
        return response()->json(['success'=>'Producto Eliminado']);
    }
}
