<?php

namespace App\Http\Controllers;

use App\Data\Data;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    public function get(){
        $settings = Setting::where('title', 'pages')->first();
        $pages = $settings->data;

        return response([
            'pages' => json_decode($pages)
        ]);
    }

    // $data
    // $arrayName
    // $id = null
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'arrayName' => 'required',
            'data' => 'required',
        ]);
        if($validator->fails()){
            return response(
                [
                    'errors' => $validator->errors()
                ], 422
            );
        }
        $settings = Setting::where('title', 'pages')->first();
        $pages = json_decode($settings->data);
        $pages = (array)$pages;
        // dd($pages);

        if($request->arrayName != 'lawyerEvents' && $request->arrayName != 'advocatsInfo'){
            $pages[$request->arrayName] = (array)json_decode($request->data);
            $settings->data = json_encode($pages);
            $settings->save();
            return response([
                'pages' => $pages
            ]);
        }

        if(!$request->id){
            return response(
                [
                    'error' => 'Id не указан!'
                ], 422
            );
        }

        // dd($pages[$request->arrayName]);
        foreach($pages[$request->arrayName] as $ind => $el){
          // dd($el);
            if($el->id == $request->id){
                $pages[$request->arrayName][$ind] = (array)json_decode($request->data);
                break;
            }
        }

        $settings->data = json_encode($pages);
        $settings->save();
        return response([
            'pages' => $pages
        ]);

    }

    public function reset(){
        $settings = Setting::where('title', 'pages')->first();
        if($settings){
          $settings->delete();
        }
        $data = Data::$data;
        // return response([
        //     'data' => json_decode($data)
        // ]);
          $settings = Setting::create([
            'title' => 'pages',
            'data' => $data
          ]);

        return response([
            'message' => 'Success!'
        ]);
    }

    public function upload(Request $request)
    {
        // Проверяем, что файл был передан
        if ($request->hasFile('file')) {
            // Получаем файл
            $file = $request->file('file');

            // Перемещаем файл в нужную директорию (storage/app/public/images)
            $path = $file->store('public/images');

            // Можно также сохранить путь в базу данных или выполнять другие операции

            return response()->json(['message' => 'Файл успешно загружен', 'path' => $path, 'file' => $file, 'id' => $request->id, 'arrayName' => $request->arrayName, 'fileFormat' => $request->fileFormat ]);
        } 
        else {
            return response()->json(['error' => 'Файл не был передан'], 400);
        }
    }
}