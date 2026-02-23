<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\TargetArea;
use App\Models\TargetMediaReceiver;
use App\Models\PublicRelation;
use App\Models\PrDistribution;
use App\Models\PublicRelationFile;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class PublicRelationController extends Controller
{
    
    public function list()
    {
        $publicRelations = PublicRelation::orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('public-relations/list', [
            'publicRelations' => $publicRelations,
        ]);
    }

    public function create()
    {
        return Inertia::render('public-relations/create', [
            'canRegister' => Features::enabled(Features::registration()),
            'areas' => TargetArea::select('id', 'name_en', 'name_jp')->get(),
        ]);
    }

    public function getReceiversByArea(Request $request)
    {
        $areaIds = $request->input('area_ids', []);

        return TargetMediaReceiver::with('targetArea')
            ->when(!empty($areaIds), function ($query) use ($areaIds) {
                $query->whereIn('target_area_id', $areaIds);
            })
            ->get();
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'pdf_file' => 'nullable|mimes:pdf|max:10240', // ไม่เกิน 10MB
            'media_ids' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            // 1. บันทึกข้อมู,ประชาสัมพันธ์ก่อน
            $pr = PublicRelation::create([
                'subject' => $request->subject,
                'content' => $request->content,
            ]);

            // 2. เชคกานอัพโลหดไฟล์
            if ($request->hasFile('pdf_file')) {
                $file = $request->file('pdf_file');
                $subPath = 'file_upload/pr_attachments/' . now()->format('Ym') . '/' . now()->format('d'); // เก็บใน storage/app/public/file_upload/pr_attachments
                $path = $file->store($subPath, 'public');

                PublicRelationFile::create([
                    'public_relation_id' => $pr->id,
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }

            // 3. บันทึกข้อมูลการเผยแพร่ข้อมูล ว่าส่งไปให้ media(ผู้รับ) คนไหนบ้าง
            foreach ($request->media_ids as $mediaId) {
                $distribution = PrDistribution::create([
                    'public_relation_id' => $pr->id,
                    'target_media_id' => $mediaId,
                    'subject' => $request->subject,
                    'detail' => $request->content,
                    'status' => 'pending',
                    'sent_at' => $request->scheduled_at,
                ]);
        
            }

            DB::commit();
            return redirect()->route('public-relations.list')->with('success', 'PR Created Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to save data: ' . $e->getMessage()]);
        }
    }

    public function edit($public_relation_id=null){

        $publicRelationsDetail = PublicRelation::where('id', 1)->first();
        $targetMediaId = PrDistribution::select('target_media_id')->where('public_relation_id', $public_relation_id)->get();

        return Inertia::render('public-relations/edit', [
            'areas' => TargetArea::select('id', 'name_en', 'name_jp')->get(),
            'targetMediaId' => $targetMediaId,
            'publicRelationsDetail' => $publicRelationsDetail,
        ]);
    }

    public function review(){
        $publicRelations = PublicRelation::orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('public-relations/review', [
            'publicRelations' => $publicRelations,
        ]);
    }
}
