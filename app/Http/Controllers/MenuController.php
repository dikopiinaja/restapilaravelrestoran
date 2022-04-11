<?php

namespace App\Http\Controllers;

// use Validator;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::orderBy('id', 'DESC')->get();
        $response = [
            'message' => 'List menu order by favorite',
            'data' => $menu
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function test()
    {
        return view('test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'category' => ['required'],
            'desc' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        } try {
            $menu = Menu::create($request->all());
            $response = [
                'message' => 'Menu created',
                'data' => $menu
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
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
        $menu = Menu::findOrFail($id);
        $response = [
            'message' => 'Menu of resource details',
            'data' => $menu
        ];

        return response()->json($response, Response::HTTP_OK);
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
        $menu = Menu::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'category' => ['required'],
            'desc' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        } try {
            $menu->update($request->all());
            $response = [
                'message' => 'Menu updated',
                'data' => $menu
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        try {
             $menu->delete();
             $response = [
                 'message' => 'Menu deleted'
             ];
 
             return response()->json($response, Response::HTTP_OK);
         } catch (QueryException $e) {
             return response()->json([
                 'message' => "Failed" . $e->errorInfo
             ]);
         }
    }
}
