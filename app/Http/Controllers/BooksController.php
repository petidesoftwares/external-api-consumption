<?php

namespace App\Http\Controllers;

use App\Models\Books;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::all();
        foreach ($books as $key=>$book){
            $book['authors'] = json_decode($book->authors,true);
            unset($book->created_at);
            unset($book->updated_at);
        }

        return response()->json([
            'status_code'=>200,
            'status'=>'success',
            'data'=>$books]);
    }

    public function externalBooks($name){
        $iceAndFire = new Client();
        $url = "https://www.anapioficeandfire.com/api/books?".$name;

        $response = $iceAndFire->request('GET', $url,[
            'verify' => false,
        ]);

        $respBody = json_decode($response->getBody());

        foreach ($respBody as $key => $requestData){
            unset($requestData->url);
            unset($requestData->characters);
            unset($requestData->povCharacters);

        }

        return response()->json([
            'status_code'=>200,
            'status' => 'success',
            'data'=>$respBody
            ]);
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
        // Validate form input
        $request->validate([
            'name' =>'required',
            'isbn' =>'required',
            'authors' =>'required',
            'country' =>'required',
            'number_of_pages' =>'required',
            'publisher' =>'required',
            'release_date'=>'required'
        ]);

        //Data to be sent to storage
        $inputData = [
            'name'=>$request->input('name'),
            'isbn'=>$request->input('isbn'),
            'authors'=>json_encode([$request->input('authors')]),
            'country'=>$request->input('country'),
            'number_of_pages'=>$request->input('number_of_pages'),
            'publisher'=>$request->input('publisher'),
            'release_date'=>$request->input('release_date'),
        ];

        //Creat record
        $create = Books::create($inputData);

        //Format output
        $create['authors'] = json_decode($create['authors'],true);
        unset($create->id);
        unset($create->created_at);
        unset($create->updated_at);

        return response()->json(['status_code'=>201,
            'status'=>'success',
            'data'=>$create]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Books::where('id',$id)->get();
        $book[0]['authors'] = json_decode($book[0]->authors,true);
        unset($book[0]->deleted_at);
        unset($book[0]->created_at);
        unset($book[0]->updated_at);

        return response()->json(['status_code'=>200,
            'status'=>'success',
            'data'=>$book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $oldName = Books::where('id',$id)->get('name');
        if($request->name != "" || $request->name != null){
            $update = Books::updateOrCreate(
                ['id'=>$id],
                ['name'=>$request->name]
            );
            $update['authors']=json_decode($update->authors,true);
            return response()->json(['status_code'=>200,
                'status'=>'success',
                'message'=>'The book '.$oldName[0]->name.' was updated successfully',
                'data'=>$update
            ]);
        }
        elseif($request->isbn != "" || $request->isbn != null){
            $update = Books::updateOrCreate(
                ['id'=>$id],
                ['isbn'=>$request->isbn]
            );
            $update['authors']=json_decode($update->authors,true);
            return response()->json(['status_code'=>200,
                'status'=>'success',
                'message'=>'The book '.$oldName[0]->name.' was updated successfully',
                'data'=>$update
            ]);
        }
        elseif($request->authors == "" || $request->authors != null){
            $update = Books::updateOrCreate(
                ['id'=>$id],
                ['authors'=>$request->authors]
            );
            $update['authors']=json_decode($update->authors,true);
            return response()->json(['status_code'=>200,
                'status'=>'success',
                'message'=>'The book '.$oldName[0]->name.' was updated successfully',
                'data'=>$update
            ]);
        }
        elseif($request->country != "" || $request->country != null){
            $update = Books::updateOrCreate(
                ['id'=>$id],
                ['country'=>$request->country]
            );
            $update['authors']=json_decode($update->authors,true);
            return response()->json(['status_code'=>200,
                'status'=>'success',
                'message'=>'The book '.$oldName[0]->name.' was updated successfully',
                'data'=>$update
            ]);
        }
        elseif($request->number_of_pages != "" || $request->number_pages != null){
            $update = Books::updateOrCreate(
                ['id'=>$id],
                ['number_of_pages'=>$request->number_of_pages]
            );
            $update['authors']=json_decode($update->authors,true);
            return response()->json(['status_code'=>200,
                'status'=>'success',
                'message'=>'The book '.$oldName[0]->name.' was updated successfully',
                'data'=>$update
            ]);
        }
        elseif($request->publisher != "" || $request->publisher != null){
            $update = Books::updateOrCreate(
                ['id'=>$id],
                ['publisher'=>$request->publisher]
            );
            $update['authors']=json_decode($update->authors,true);
            return response()->json(['status_code'=>200,
                'status'=>'success',
                'message'=>'The book '.$oldName[0]->name.' was updated successfully',
                'data'=>$update
            ]);
        }
        elseif($request->release_date != "" || $request->release_date != null){
            $update = Books::updateOrCreate(
                ['id'=>$id],
                ['release_date'=>$request->release_date]
            );
            $update['authors']=json_decode($update->authors,true);
            return response()->json(['status_code'=>200,
                'status'=>'success',
                'message'=>'The book '.$oldName[0]->name.' was updated successfully',
                'data'=>$update
            ]);
        }else{
            return response()->json([
                'status_code'=>404,
                'status'=>'Not Found',
                'message'=>'Book not found']);
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
        $book = Books::find($id);
        $name = $book->name;

        $book->delete();
        $deleted = Books::where('id',$id)->get();
        return response()->json(['status_code'=>204,
            'status'=>'success',
            'message'=>'The book '.$name.' was deleted successfully',
            'data'=>$deleted]);
    }
}
