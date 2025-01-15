@extends('layouts.main')

@section('content')
 <form action="{{}}" method="POST">
     @csrf
     <label for="faction"></label>
     <select id="faction">

     </select>
 </form>
@endsection
