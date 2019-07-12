<?php

namespace App\Http\Controllers;

use Redirect;
use Request;
use Validator;
use DateTime;

class OperationController extends Controller
{
    public function index() {

        $response = file_get_contents('https://agrcf.lib.id/exercice@dev/');
        $response = json_decode($response);
        $operations = $response->operations;

        $ribs = [];
        foreach( $operations as $operation) {
            if(!in_array($operation->RIB, $ribs))
                array_push($ribs, $operation->RIB);
        }

        return view('operation')->with('ribs', $ribs);
    }

    public function store(request $request) {

        $value = request::all();

        $rules = [
            'operation' => 'required|string|max:255',
            'rib' => 'required|string',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date|after:dateStart',
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
            'dateEnd.after' => 'La date de fin ne peut pas être inférieur à la date de début',
        ]);

        if($validator->fails()) {

            return Redirect::back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $response = file_get_contents('https://agrcf.lib.id/exercice@dev/');
        $response = json_decode($response);
        $operations = $response->operations;

        if($value['operation'] == 'Liste des opérations') {
            
            $results = [];
            foreach($operations as $operation) {
            
                dd(strtotime($operation->Date));
                $dateOperation = new DateTime($operation->Date);
                $interval = $value['dateStart']->diff($dateOperation);
                dd($interval);  
                
                if($value['rib'] == $operation->RIB) {
                    if($value['dateStart'] <= $dateOperation && $value['dateEnd'] >= $dateOperation) {
                        array_push($results, $operation);
                    }
                }
            }
        }

        return view('results')->with('results', $results);
    }
}
