<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Report;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getExecutiveSummary(){
        $summary = Setting::where('field_name','executive_summary')->first();
        $summary = $summary?($summary->field_text_value?$summary->field_text_value:""):"";
        return response()->json([
            'summary' => $summary
        ]);
    }

    public function updateExecutiveSummary(Request $request){
        $summary = Setting::where('field_name','executive_summary')->first();
        $summary->field_text_value = $request->summary;
        $summary->save();
        $summary = $summary?($summary->field_text_value?$summary->field_text_value:""):"";
        return response()->json([
            'summary' => $summary
        ]);
    }

    public function getStats(){

        $groupsCount = Group::count();
        $customersCount = Customer::count();
        $reportsCount = Report::count();

        return response()->json([
            'customers' => $customersCount,
            'reports' => $reportsCount,
            'groups' => $groupsCount,
        ]);

    }
}
