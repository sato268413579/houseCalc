<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('layout')
    <head>
        @include('head')
    </head>
    <body>
        <header>
            @include('header')
        </header>
        @section('content')
        <div>
            @foreach($monthData as $val)
                <label>{{$val->month}}</label><br>
            @endforeach
        </div>
        
        <div class="form-group">
            <label for="text1">食費</label>
            <input type="text" id="text1" class="form-control">
        </div>
        @endsection
    </body>
</html>
