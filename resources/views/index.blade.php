@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-5">

            <h1>Recherche d'opérations bancaires</h1>

            <form method="post">

            {{ csrf_field() }}

                <div class="form-group">
                    <label for="operation">Séléctionner un type d'opération :</label>
                    <select id="operation" name="operation" class="form-control">
                        <option>Liste des opérations</option>
                        <option>Calcul du solde</option>
                    </select>
                    @error('operation')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="rib">Séléctionner un RIB :</label>
                    <select id="rib" name="rib" class="form-control">
                        @foreach ($ribs as $rib)
                                <option>{{ $rib }}</option>
                        @endforeach
                    </select>
                    @error('rib')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="start">Date de début :</label>
                    <input type="date" id="start" name="dateStart" class="form-control">
                    @error('dateStart')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="end">Date de fin :</label>
                    <input type="date" id="end" name="dateEnd" class="form-control">
                    @error('dateEnd')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-info">Valider</button>
            </form>
        
        </div>

    </div>

</div>

@endsection