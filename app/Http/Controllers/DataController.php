<?php

namespace App\Http\Controllers;

use App\Data\Data;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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

    public function uploadFile(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');

            $path = $file->store('files');

            $settings = Setting::where('title', 'pages')->first();
            $pages = json_decode($settings->data);
            $pages = (array)$pages;
            $data = null;
            foreach($pages[$request->arrayName] as $ind => $el){
                if($el->id == $request->id){
                        $data = $pages[$request->arrayName][$ind];
                        if($request->fileFormat == 'img'){
                            $filePath = public_path($data->img);
                            if(File::exists($filePath)) {
                              File::delete($filePath);
                            }
                            $data->img = $path;
                        }
                        else{
                            $filePath = public_path($data->pdf);
                            if(File::exists($filePath)) {
                              File::delete($filePath);
                            }
                            $data->pdf = $path;
                        }
                        $pages[$request->arrayName][$ind] = $data;
                        break;
                }
            }
            $settings->data = json_encode($pages);
            $settings->save();
            return response()->json(['message' => 'Файл успешно загружен', 'path' => $path, 'id' => $request->id, 'arrayName' => $request->arrayName, 'fileFormat' => $request->fileFormat, 'text' => $request->text, ]);
        } else {
            return response()->json(['error' => 'Файл не был передан'], 400);
        }
    }

    public function addSlide(Request $request){
        // return response(['text' => $request->textz]);
        $text = json_decode($request->text);
        if ($request->hasFile('filePdf') && $request->hasFile('fileImg')) {
            $filePdf = $request->file('filePdf');
            $fileImg = $request->file('fileImg');

            $pathPdf = $filePdf->store('files');
            $pathImg = $fileImg->store('files');

            $settings = Setting::where('title', 'pages')->first();
            $pages = json_decode($settings->data);
            $pages = (array)$pages;
            $slide = ['slideText' => ['rus' => $text->rus, 'eng' => $text->eng], 'img' => $pathImg, 'pdf' => $pathPdf, 'id' => (int)$request->lastId+1];
            $slide = json_encode($slide);
            $slide = json_decode($slide);
            $pages['slideEvents'][] = $slide;

            $settings->data = json_encode($pages);
            $settings->save();
            return response()->json(['message' => 'Файл успешно загружен', 'pathPdf' => $pathPdf, 'lastId' => $request->lastId ]);
        } else {
            return response()->json(['error' => 'Файл не был передан'], 400);
        }
    }

    public function deleteSlide(Request $request){
        // return response(['id' => $request->id]);
        $settings = Setting::where('title', 'pages')->first();
        $pages = json_decode($settings->data);
        $pages = (array)$pages;
        foreach($pages['slideEvents'] as $ind => $slide){
            // return response(['id' => $slide->id, 'id' => $request->id]);
            if($request->id == $slide->id){
                $data = $pages['slideEvents'][$ind];
                $filePathPdf = public_path($data->pdf);
                if(File::exists($filePathPdf)){
                  File::delete($filePathPdf);
                }
                $filePathImg = public_path($data->img);
                if(File::exists($filePathImg)){
                  File::delete($filePathImg);
                }
                unset($pages['slideEvents'][$ind]);
            }
        }
        $pages['slideEvents'] = (array)array_values($pages['slideEvents']);
        $settings->data = json_encode($pages);
        $settings->save();
    }

    //$id
    //$arrayName
    public function deletePdf(Request $request){
        $settings = Setting::where('title', 'pages')->first();
        $pages = json_decode($settings->data);
        $pages = (array)$pages;
        foreach($pages[$request->arrayName] as $ind => $item){
            // return response(['id' => $slide->id, 'id' => $request->id]);
            if($request->id == $item->id){
                $data = $pages['slideEvents'][$ind];
                $filePathPdf = public_path($data->pdf);
                if(File::exists($filePathPdf)){
                  File::delete($filePathPdf);
                }
                $pages[$request->arrayName][$ind]->pdf = '';
            }
        }
        $settings->data = json_encode($pages);
        $settings->save();
    }

    //lastId
    public function addLawyerEvent(Request $request){
        $settings = Setting::where('title', 'pages')->first();
        $pages = json_decode($settings->data);
        $pages = (array)$pages;
        $event = [
            "cardHeader" => [
                  "rus" => "", 
                  "eng" => "" 
               ], 
            "cardText" => [
                     "rus" => "", 
                     "eng" => "" 
                  ], 
            "content" => [
                        "rus" => "", 
                        "eng" => "" 
                     ], 
            "img" => "", 
            "pdf" => "", 
            "id" => (int)$request->lastId+1
        ];
        $event = json_encode($event);
        $event = json_decode($event);
        $pages['lawyerEvents'][] = $event;
        $settings->data = json_encode($pages);
        $settings->save();
    }

    public function deleteLawyerEvent(Request $request){
        // return response(['id' => $request->id]);
        $settings = Setting::where('title', 'pages')->first();
        $pages = json_decode($settings->data);
        $pages = (array)$pages;
        foreach($pages['lawyerEvents'] as $ind => $slide){
            // return response(['id' => $slide->id, 'id' => $request->id]);
            if($request->id == $slide->id){
                $data = $pages['lawyerEvents'][$ind];
                $filePathPdf = public_path($data->pdf);
                if(File::exists($filePathPdf)){
                  File::delete($filePathPdf);
                }
                $filePathImg = public_path($data->img);
                if(File::exists($filePathImg)){
                  File::delete($filePathImg);
                }
                unset($pages['lawyerEvents'][$ind]);
            }
        }
        $pages['lawyerEvents'] = (array)array_values($pages['lawyerEvents']);
        $settings->data = json_encode($pages);
        $settings->save();
    }
}