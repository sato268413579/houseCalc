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
            
            <div class="form-group">
                <p class="control-label"><b>種別</b></p>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" value="1" name="gender" id="sum" checked>
                    <label for="sum" class="mb-0">合計</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" value="2" name="gender" id="registerDay">
                    <label for="registerDay" class="mb-0">登録日</label>
                </div>
            </div>
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
