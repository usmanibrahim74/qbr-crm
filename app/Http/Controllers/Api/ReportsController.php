<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Report;
use App\Models\ReportItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{


    public function index(){


        $reports = Report::with(['customer'])->get();
        return response()->json($reports);

    }

    public function getReport($id){


        $report = $this->getReportById($id);
        return response()->json($report);

    }

    private function getReportById($id){
        return Report::with(['customer','groups.reportItems'=>function($q)use($id){
            return $q->where('report_id',$id)->with(['groupItem','risk']);
        }])->find($id);
    }

    public function addReport(Request $request){
        $groups = array();
        if(count($request->groups)){
            foreach ($request->groups as $group){
                array_push($groups, $group['value']);
            }
        }
        if(count($groups)){

            $report = new Report();
            $report->name = $request->name;
            $report->customer_id = $request->customer;
            $report->date = $request->date;
            $report->user_id = Auth::id();

            $report->save();
            $report->groups()->attach($groups);
            return response()->json([
                'status' => 'success',
                'message' => 'report created successfully'
            ]);

        }
        return response()->json([
            'status' => 'error',
            'message' => 'some error occured'
        ]);
    }

    public function updateItem(Request $request,$id){
        $reportItem = ReportItem::findOrFail($id);
        $reportItem->fill($request->toArray())->save();
        $reportItem->load(['groupItem','risk']);
        return response()->json($reportItem);
    }

    public function deleteGroup($report_id, $group_id){
        $report = Report::findOrFail($report_id);
        $report->groups()->detach([$group_id]);
        $report->reportItems()->where('group_id',$group_id)->delete();
        return response()->json($this->getReportById($report_id));
    }
    public function deleteItem($report_id, $item_id){
        $report = Report::findOrFail($report_id);
        $report->reportItems()->where('id',$item_id)->delete();
        return response()->json($this->getReportById($report_id));
    }

    public function addGroup(Request $request, $report_id){

        $report = Report::findOrFail($report_id);
        $report->groups()->attach([$request->group_id]);
        if($request->item_id){
            $reportItem = new ReportItem();
            $reportItem->report_id = $report_id;
            $reportItem->group_id = $request->group_id;
            $reportItem->group_item_id = $request->item_id;
            $reportItem->notes = "";
            $reportItem->solution = "";
            $reportItem->qtr = "";
            $reportItem->status = "Satisfactory";
            $reportItem->budget = "";
            $reportItem->target_year = "";
            $reportItem->save();
        }
        return response()->json($this->getReportById($report_id));

    }

    public function addItem(Request $request, $report_id){

        $group = Group::with('items')->find($request->group_id);
        $group_item_id = $group->items[0]->id;
        $reportItem = new ReportItem();
        $reportItem->report_id = $report_id;
        $reportItem->group_id = $request->group_id;
        $reportItem->group_item_id = $group_item_id;
        $reportItem->notes = "";
        $reportItem->solution = "";
        $reportItem->qtr = "";
        $reportItem->risk_id = 1;
        $reportItem->budget = "";
        $reportItem->target_year = "";
        $reportItem->save();
        $reportItem->load('risk');
        return response()->json($this->getReportById($report_id));

    }

    public function deleteReport($report_id){

        $report = Report::findOrFail($report_id);
        $report->groups()->sync([]);
        $report->reportItems()->delete();
        $report->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Report has been deleted'
        ]);
    }

    public function updateReport(Request $request, $id){
        $report = $this->getReportById($id);
        $report->fill($request->all());
        $report->save();
        return response()->json($report);
    }

    public function generateReport($id){
        $report = $this->getReportById($id);

//        $this->view('report');
        return view('report', compact('report'));
    }
}
