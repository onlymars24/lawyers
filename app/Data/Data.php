<?php

namespace App\Data;


class Data
{
    public static $data = '{
    "slideEvents": [
      {
        "slideText": "",
        "img": "slideImg1.jpg",
        "pdf": "slide1.pdf",
        "id": 0
      },
      {
        "slideText": "",
        "img": "slide2.png",
        "pdf": "slide2.pdf",
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
      },
      {
        "text": {
            "rus": "Статья2",
            "eng": "article2"
        },
        "id": 3
      },
      {
        "text": {
            "rus": "Статья2",
            "eng": "article2"
        },
        "id": 4
      },
      {
        "text": {
            "rus": "Статья2",
            "eng": "article2"
        },
        "id": 5
      },
      {
        "text": {
            "rus": "Статья2",
            "eng": "article2"
        },
        "id": 6
      },
      {
        "text": {
            "rus": "Статья2",
            "eng": "article2"
        },
        "id": 7
      },
      {
        "text": {
            "rus": "Статья2",
            "eng": "article2"
        },
        "id": 8
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
        "pdf": "rudich.pdf",
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
        "pdf": "Abramov.pdf",
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
        "img": "slide2.png",
        "pdf": "slide2.pdf",
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
        "img": "slide2.png",
        "pdf": "slide2.pdf",
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

      public static function dataObj(){
        return self::$data;
      }
}