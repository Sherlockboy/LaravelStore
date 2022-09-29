@extends('layouts.app')

@section('content')
    <h1>{{ __("This is category page for category with name {$category->name} and id {$category->id}") }}</h1>
@endsection