<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('layout')
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('head')
    </head>
    <body>
        <header>
            @include('header')
        </header>
        @section('content')
            <div class="form-group row">
                <select id="toMonth" class="form-control w-25">
                @for($i = 1; $i < 13;$i++)
                    <option>{{date('Y/m', strtotime(date('Y/').$i.'/1'))}}
                @endfor
                </select>
                <button class="btn btn-success text-right ml-5" onclick="btnCreateShow()">表示</button>
            </div>
            <div id="errMsg"></div>
            <div id="tableShowData"></div>

        @endsection
    </body>
</html>
