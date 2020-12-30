<?php

namespace App\Http\Controllers\Dashboard;

use App\Section;
use App\SubSection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubSectionController extends Controller
{
    public function showSubSection(){
        $getSections = Section::get();
        $getSubSections = SubSection::get();
        return view('backend.layouts.section_sub_item.subSectionItem', compact('getSections', 'getSubSections'));
    }

    public function addSubSection(Request $request){
        SubSection::create([
            'section_id'=> $request->section_id,
            'sub_section_name'=>$request->sub_section_name,
            'slug'=> Str::slug(Section::find($request->section_id)->section_name."-".$request->sub_section_name),
            'status'=>1
        ]);

        $message = "Sub Section Created Successfully !!";
        return back()->with('success', $message);
    }

    public function updateSubSectionStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            SubSection::where('id', $data['subSection_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'subSection_id' => $data['subSection_id']]);
        }
    }

    public function deleteSubSection($id){
        $subSection = SubSection::find($id);
        $subSection->delete();
        $message = "Sub Section Delete Successfully !!";
        return redirect()->back()->with('success', $message);
    }
}
