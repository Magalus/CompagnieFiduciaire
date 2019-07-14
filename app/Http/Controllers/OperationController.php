<?php

namespace App\Http\Controllers;

use Redirect;
use Request;
use Validator;
use DateTime;
use Carbon\Carbon;

class OperationController extends Controller
{
    public function index() {

        // Appel à l'API

        $response = file_get_contents('https://agrcf.lib.id/exercice@dev/');
        $response = json_decode($response);
        $operations = $response->operations;

        // Recherche des différents RIB 

        $ribs = [];
        foreach( $operations as $operation) {
            if(!in_array($operation->RIB, $ribs))
                array_push($ribs, $operation->RIB);
        }

        return view('index')->with('ribs', $ribs);
    }

    public function store(request $request) {

        // Validation du formulaire

        $value = request::all();

        $rules = [
            'operation' => 'required|string|max:255',
            'rib' => 'required|string',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date|after_or_equal:dateStart',
        ];

        $validator = Validator::make($value, $rules, [
            'operation.required' => 'Veuillez indiquer un type d\'opération',
            'operation.integer' => 'Format inattendu',
            'rib.required' => 'Veuillez indiquer un RIB',
            'rib.integer' => 'Format inattendu',
            'dateStart.date' => 'Veuillez indiquer une date au format valide',
            'dateStart.required' => 'Veuillez indiquer une date de départ',
            'dateEnd.date' => 'Veuillez indiquer une date au format valide',
            'dateEnd.required' => 'Veuillez indiquer une date de fin',
            'dateEnd.after_or_equal' => 'La date de fin ne peut pas être inférieure à la date de début',
        ]);

        if($validator->fails()) {

            return Redirect::back()
                            ->withErrors($validator)
                            ->withInput();
        }

        // Appel à l'API

        $response = file_get_contents('https://agrcf.lib.id/exercice@dev/');
        $response = json_decode($response);
        $operations = $response->operations;

        //Recherche des opérations correspondant aux dates et RIB séléctionnés

        $results = [];
        foreach($operations as $operation) {

            $dateOperation = str_replace('/', '-', $operation->Date);
            $dateOperation = carbon::parse($dateOperation)->format('Y-m-d');        

            if($value['rib'] == $operation->RIB) {
                if($value['dateStart'] <= $dateOperation && $value['dateEnd'] >= $dateOperation) {
                    array_push($results, $operation);
                }
            }
        }

        // Rangement des opérations par date

        if($value['operation'] == 'Liste des opérations') {

            return view('operations')->with('results', $results);
        }

        // Calcul du solde

        else if($value['operation'] == 'Calcul du solde') {

            $rib = $value['rib'];

            $solde = 0;
            foreach($results as $result) {

                $solde = $solde + intval($result->Montant);
            }

            return view('solde')->with('solde', $solde)->with('rib', $rib);
        }
    }
}
