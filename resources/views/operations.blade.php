@extends('layouts.app')

@section('content')

@if($results == null)
    <div class="row justify-content-center">
        <div>Aucune opération effectuée sur la période indiquée</div>
    </div>
@else 

<div class="container-fluid">

    <div class="row justify-content-center">

        <ul class="col-sm-12 col-md-10 col-lg-8 col-xl-6 list-group">

            @foreach($results as $result)

                <li class="list-group-item">
                    <div class="row">
                        <div class="col-6">
                            <div>RIB : {{ $result->RIB }}</div>
                            <div>Date : {{ $result->Date }}</div>
                            <div>Libelle : {{ $result->Libelle }}</div>
                            <div>Devise : {{ $result->Devise }}</div>
                        </div>
                        <div class="col-3">
                            <div>Recette</div><hr>
                            @if($result->Montant > 0 )
                                <div>{{ $result->Montant }}€</div>
                            @else
                                <div>0€</div>
                            @endif
                        </div>
                        <div class="col-3">
                            <div>Dépense</div><hr>
                            @if($result->Montant < 0 )
                                <div>{{ abs($result->Montant) }}€</div>
                            @else
                                <div>0€</div>
                            @endif
                        </div>
                    </div>
                </li>

            @endforeach
            
        </ul>

    </div>

</div>

@endif

@endsection