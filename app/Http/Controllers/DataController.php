<?php

namespace App\Http\Controllers;

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
        $data = '{   "slide": [
            {
              "slideText": {
                "rus": "слайдтекст1",
                "eng": "slidetext1"
              },
              "slideImg": "slideImg1.jpg",
              "id": 0
            },
            {
            "slideText": {
                "rus": "слайдтекст2",
                "eng": "slidetext2"
            },
            "slideImg": "slideImg1.jpg",
            "id": 1
            }
          ],
          "slideEvents": [
            {
              "slideText": "",
              "slideImg": "slideImg1.jpg",
              "id": 0
            },
            {
              "slideText": "",
              "slideImg": "slide2.png",
              "id": 1
            }
          ],
          "articles": [
            {
              "text": {
                "rus": "Статья1",
                "eng": "article1"
              },
              "id": 1
            },
            {
                "text": {
                    "rus": "Статья2",
                    "eng": "article2"
                },
                "id": 2
            }
          ],
      
          "advocatsInfo": [
            {
              "id": "Rudich_V_V",
              "name": {
                "rus": "Рудич В.В.",
                "eng": "Rudich V.V."
              },
              "fullName": {
                "rus": "Рудич Валерий Владимирович",
                "eng": "Rudich Valery Vladimirovich"
              },
              "info": {
                "rus": " Рудич",
                "eng": " Rudich"
              },
              "img": "rudich.png",
              "tel": "8(932)244-23-11",
              "telLink": "8932244231",
              "email": "sadural@mail.ru",
              "address": { "ru": "ЕКБ", "eng": "EKB" },
              "tgNikname": ""
            },
            {
              "id": "Abraamov_V_V",
              "name": {
                "rus": "Абрамов А.Б.",
                "eng": "Abramov A.B."
              },
              "fullName": {
                "rus": "Абрамов Александр Борисович",
                "eng": "Abramov Alexander Borisovich"
              },
              "info": {
                "rus": "Абрамов",
                "eng": " Abramov"
              },
              "img": "Abramov.png",
              "tel": "8(932)244-23-11",
              "telLink": "8932244231",
              "email": "sadural@mail.ru",
              "address": { "rus": "ЕКБ", "eng": "EKB" },
              "tgNikname": ""
            }
          ],
          "lawyerEvents": [
            {
              "cardHeader": {
                "rus": "Круглый стол",
                "eng": "Round table"
              },
              "cardText": {
                "rus": "Проблемы злоупотребления при возбуждении уголовных дел",
                "eng": "Problems of abuse in the initiation of criminal cases"
              },
              "content": {
                "rus": "контент1",
                "eng": "contyent1"
              },
              "id": "круглый_стол"
            },
            {
              "cardHeader": {
                "rus": "Круглый стол",
                "eng": "Round table"
              },
              "cardText": {
                "rus": "Проблемы злоупотребления при возбуждении уголовных дел",
                "eng": "Problems of abuse in the initiation of criminal cases"
              },
              "content": {
                "rus": "Контент1",
                "eng": "Content1"
              },
              "id": "Некруглый_стол"
            }
      
          ],
          "LegalCenter": {
            "header": {
              "rus": "Автономная",
              "eng": "Autonomous"
            },
            "text": {
              "rus": "Цель",
              "eng": "The purpose"
            }
          }}';
          
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
        if ($request->hasFile('image')) {
            // Получаем файл
            $file = $request->file('image');

            // Перемещаем файл в нужную директорию (storage/app/public/images)
            $path = $file->store('public/images');

            // Можно также сохранить путь в базу данных или выполнять другие операции

            return response()->json(['message' => 'Файл успешно загружен', 'path' => $path]);
        } else {
            return response()->json(['error' => 'Файл не был передан'], 400);
        }
    }

}