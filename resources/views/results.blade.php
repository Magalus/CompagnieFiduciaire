@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-6">

            <ul class='list-group'>
                @foreach($results as $result)
                    <li class='list-group-item'>
                        <div>{{ $result->RIB }}</div>
                        <div>{{ $result->Date }}</div>
                        <div>{{ $result->Libelle }}</div>
                        <div>{{ $result->Montant }}</div>
                        <div>{{ $result->Devise }}</div>
                    </li>
                @endforeach
            </ul>

        </div>

    </div>

</div>

@endsection