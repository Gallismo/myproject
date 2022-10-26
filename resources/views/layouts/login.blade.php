@extends('layouts.main')

@section('title', 'Вход')

@section('content')
    <div id="app">
        <router-view></router-view>
    </div>
    @if(session()->has('errorTitle'))
        @include('components.notifboot')
    @endif
@endsection
