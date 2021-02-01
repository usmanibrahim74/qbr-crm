<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupItem;
use Illuminate\Http\Request;


class GroupsController extends Controller
{
    public function index(Request $request){

        if($request->withItems){
            $groups = Group::with('items')->get();
        }else{
            $groups = Group::all();
        }
        return response()->json($groups);

    }

    public function addGroup(){
        $groups_count = Group::count();
        $group = new Group();
        $group->order = $groups_count+1;
        $group->name = "";
        $group->save();
        $group->load('items');
        return response()->json($group);
    }

    public function addItem(Request $request){
        $group = Group::withCount('items as items_count')->where('id',$request->group_id)->first();


        $groupItem = new GroupItem();
        $groupItem->name = "";
        $groupItem->group_id = $group->id;
        $groupItem->order = $group->items_count + 1;
        $groupItem->save();
        return response()->json($groupItem);
    }

    public function updateItem($id, Request $request){
        $groupItem = GroupItem::find($id);
        $groupItem->name = $request->item_name;
        $groupItem->save();
        return response()->json($groupItem);
    }
    public function updateGroup($id, Request $request){
        $group = Group::find($id);
        $group->name = $request->group_name;
        $group->save();
        return response()->json($group);
    }


    public function deleteGroup($id){
        $group = Group::find($id);
        $group->delete();
        return response()->json([
            'status' => 'success',
            'message' => "Group has been deleted successfully",
        ]);
    }
    public function deleteItem($id){
        $groupItem = GroupItem::find($id);
        $groupItem->delete();
        return response()->json([
            'status' => 'success',
            'message' => "Group item has been deleted successfully",
        ]);
    }
}
