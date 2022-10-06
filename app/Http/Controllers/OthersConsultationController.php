<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\consultation;
class OthersConsultationController extends Controller
{
    public function consultations_others()
    {

        $consultations=consultation::where('is_on_exam',0)
        ->where('department_id',Auth::user()->doctor->department_id)
        ->where('consulted_by','!=',Auth::user()->doctor->id)
        ->orderBy('updated_at','desc')->get();

        $consultations=collect($consultations)->map(function($item,$key)
        {
            $patient_name=$item->patient->pre_name.' '.$item->patient->fname;
            return [
                'id'=>$item['id'],
                'patient_id'=>$item['id'],
                'consulted_by'=>$item['id'],
                'patient_name'=>$patient_name,
                'patient_phone'=>$item->patient->phone,
                'doctor_name'=>$item->doctor->user->name,
                 ];
        });
        
        return view('pages.consultation.others_consultation_list',['consultations'=>$consultations]);

    }
}
