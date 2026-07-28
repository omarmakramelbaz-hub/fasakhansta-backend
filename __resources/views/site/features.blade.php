@extends('site.index')
@section('title', trans('site.features') )
@section('content')
      </header>
  <main>
          @include('site.includes.feature-section',['features' => $features])
  </main>
@endsection