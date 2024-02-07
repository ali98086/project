<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Models\Setting\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        if ($setting === null) {

            Setting::factory()->create([
                'title' => 'عنوان سایت',
                'description' => 'توضیحات سایت',
                'keywords' => 'کلمات کلیدی سایت',
                'logo' => 'pic.jpg',
                'icon' => 'pic.jpg'
            ]);

            $setting = Setting::first();
        }

        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {

        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        
        $inputs = $request->all();

        if (!File::isDirectory(public_path('images'.DIRECTORY_SEPARATOR.'setting'))) {

            File::makeDirectory(public_path('images'.DIRECTORY_SEPARATOR.'setting'), 0755, true);
        }

        if ($request->hasFile('logo')) {

            $logoFile= Str::of(public_path($setting->logo))->contains('logo');

            if ($logoFile == true) {

                File::delete(public_path($setting->logo));
                $manager = new ImageManager(new Driver());
                $logo = $manager->read($request->file('logo'));
                $logoName = 'logo' . '.' . $request->file('logo')->getClientOriginalExtension();
                $logo->save(public_path('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.$logoName));
                $logoPath = 'images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.$logoName;
                $inputs['logo'] = $logoPath;

            } 
        }

        if ($request->hasFile('icon')) {

            $iconFile= Str::of(public_path($setting->icon))->contains('icon');

            if ($iconFile == true) {

                File::delete(public_path($setting->icon));
                $manager = new ImageManager(new Driver());                 
                $icon = $manager->read($request->file('icon'));  
                $iconName = 'icon' . '.' . $request->file('icon')->getClientOriginalExtension();
                $icon->save(public_path('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.$iconName));
                $iconPath = 'images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.$iconName;
                $inputs['icon'] = $iconPath;

            }
        }

        $setting->update($inputs);
        return redirect()->route('admin.setting.index')->with('swal-success', 'تنظیمات سایت با موفقیت ویرایش شد');
    }
}
