@extends('layouts.app.app')

@section('add-js')
	<script src="{{ URL::asset('/Gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('/Gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endsection

@section('content')
	<div id="app-content">
		<products-index :products="{{ $products }}" :categories="{{ $categories }}"></products-index>
	</div>
@endsection