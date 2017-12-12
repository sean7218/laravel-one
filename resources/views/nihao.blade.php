@extends('layouts.main')

@section('content')
    <h1>HIIIII</h1>
    {{{ $data['name'] }}}
    
    @if (isset($data['last_name']))
        {{{ $data['last_name']}}}
    @else
        No Last Name Set
    @endif

    @foreach($data as $item)
        <li>{{{ $item }}}</li>
    @endforeach
@stop