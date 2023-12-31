<?php

use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

    Route::get('/', function () {
      // dd(public_path(''));
      $filePath = public_path('');
      if(File::exists($filePath)) {
        File::delete($filePath);
        return "Файл успешно удален";
      }
      dd('Da!');
    });

    // Route::get('/add', function () {
      // $data = '{   "slide": [
      //     {
      //       "slideText": {
      //         "rus": "слайдтекст1",
      //         "eng": "slidetext1"
      //       },
      //       "slideImg": "slideImg1.jpg",
      //       "id": 0
      //     },
      //     {
      //     "slideText": {
      //         "rus": "слайдтекст2",
      //         "eng": "slidetext2"
      //     },
      //     "slideImg": "slideImg1.jpg",
      //     "id": 1
      //     }
      //   ],
      //   "slideEvents": [
      //     {
      //       "slideText": "",
      //       "slideImg": "slideImg1.jpg",
      //       "id": 0
      //     },
      //     {
      //       "slideText": "",
      //       "slideImg": "slide2.png",
      //       "id": 1
      //     }
      //   ],
      //   "articles": [
      //     {
      //       "text": {
      //         "rus": "Статья1",
      //         "eng": "article1"
      //       },
      //       "id": 1
      //     },
      //     {
      //         "text": {
      //             "rus": "Статья2",
      //             "eng": "article2"
      //         },
      //         "id": 2
      //     }
      //   ],
    
      //   "advocatsInfo": [
      //     {
      //       "id": "Rudich_V_V",
      //       "name": {
      //         "rus": "Рудич В.В.",
      //         "eng": "Rudich V.V."
      //       },
      //       "fullName": {
      //         "rus": "Рудич Валерий Владимирович",
      //         "eng": "Rudich Valery Vladimirovich"
      //       },
      //       "info": {
      //         "rus": " Рудич",
      //         "eng": " Rudich"
      //       },
      //       "img": "rudich.png",
      //       "tel": "8(932)244-23-11",
      //       "telLink": "8932244231",
      //       "email": "sadural@mail.ru",
      //       "address": { "ru": "ЕКБ", "eng": "EKB" },
      //       "tgNikname": ""
      //     },
      //     {
      //       "id": "Abraamov_V_V",
      //       "name": {
      //         "rus": "Абрамов А.Б.",
      //         "eng": "Abramov A.B."
      //       },
      //       "fullName": {
      //         "rus": "Абрамов Александр Борисович",
      //         "eng": "Abramov Alexander Borisovich"
      //       },
      //       "info": {
      //         "rus": "Абрамов",
      //         "eng": " Abramov"
      //       },
      //       "img": "Abramov.png",
      //       "tel": "8(932)244-23-11",
      //       "telLink": "8932244231",
      //       "email": "sadural@mail.ru",
      //       "address": { "rus": "ЕКБ", "eng": "EKB" },
      //       "tgNikname": ""
      //     }
      //   ],
      //   "lawyerEvents": [
      //     {
      //       "cardHeader": {
      //         "rus": "Круглый стол",
      //         "eng": "Round table"
      //       },
      //       "cardText": {
      //         "rus": "Проблемы злоупотребления при возбуждении уголовных дел",
      //         "eng": "Problems of abuse in the initiation of criminal cases"
      //       },
      //       "content": {
      //         "rus": "контент1",
      //         "eng": "contyent1"
      //       },
      //       "id": "круглый_стол"
      //     },
      //     {
      //       "cardHeader": {
      //         "rus": "Круглый стол",
      //         "eng": "Round table"
      //       },
      //       "cardText": {
      //         "rus": "Проблемы злоупотребления при возбуждении уголовных дел",
      //         "eng": "Problems of abuse in the initiation of criminal cases"
      //       },
      //       "content": {
      //         "rus": "Контент1",
      //         "eng": "Content1"
      //       },
      //       "id": "Некруглый_стол"
      //     }
    
      //   ],
      //   "LegalCenter": {
      //     "header": {
      //       "rus": "Автономная",
      //       "eng": "Autonomous"
      //     },
      //     "text": {
      //       "rus": "Цель",
      //       "eng": "The purpose"
      //     }
      //   }}';
        
      //   $settings = Setting::create([
      //     'title' => 'pages',
      //     'data' => $data
      //   ]);
      
    //   $settings = Setting::where('title', 'pages')->first();
    //   $pages = json_decode($settings->data);
    //   dd((array)$pages);
      
    //   return view('welcome');
    // });