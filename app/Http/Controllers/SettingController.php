<?php

namespace App\Http\Controllers;

use App\Models\FrontEndSetting;
use Illuminate\Http\Request;
use App\Models\Partner;

class SettingController extends Controller
{
	
	public function __construct() {
		$this->middleware('admin');
	}
	
    public function index() {
        $settings = FrontEndSetting::all();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request) {
        foreach ($request->settings as $key => $value) {
            FrontEndSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return redirect()->back();
    }
    
    public function edit() {
        $partners = Partner::all();
        return view('admin.partners.edit', compact('partners'));
    }
    
    public function update(Request $request) {
        $validatedData = $request->validate([
            'partners.*.id' => 'required|exists:partners,id',
            'partners.*.brand_name' => 'required|string|max:255',
            'partners.*.brand_image' => 'required|string|max:255',
        ]);

        foreach ($validatedData['partners'] as $partnerData) {
            $partner = Partner::find($partnerData['id']);
            $partner->update($partnerData);
        }

        return redirect()->route('admin.partners.edit')->with('success', 'Partners updated successfully');
    }
    
}