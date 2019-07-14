@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">
        
        <span>Sur la période donnée le solde du compte n° {{ $rib }} est de : {{ $solde }}€</span>

    </div>

</div>
@endsection