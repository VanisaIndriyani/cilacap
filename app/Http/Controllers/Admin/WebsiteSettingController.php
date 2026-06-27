<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use App\Support\Uploads;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebsiteSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => WebsiteSetting::current(),
        ]);
    }

    public function update(Request $request)
    {
        $settings = WebsiteSetting::current();

        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'about' => ['nullable', 'string'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_email' => ['nullable', 'string', 'max:255'],
            'contact_address' => ['nullable', 'string'],
            'footer_text' => ['nullable', 'string'],
            'social_instagram' => ['nullable', 'string', 'max:255'],
            'social_facebook' => ['nullable', 'string', 'max:255'],
            'social_tiktok' => ['nullable', 'string', 'max:255'],
            'social_youtube' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:4096'],
            'banner' => ['nullable', 'image', 'max:6144'],
        ]);

        $social = [
            'Instagram' => $data['social_instagram'] ?? null,
            'Facebook' => $data['social_facebook'] ?? null,
            'TikTok' => $data['social_tiktok'] ?? null,
            'YouTube' => $data['social_youtube'] ?? null,
        ];

        $data['social_links'] = collect($social)->filter()->all();

        unset($data['social_instagram'], $data['social_facebook'], $data['social_tiktok'], $data['social_youtube']);

        if ($request->boolean('remove_logo')) {
            Uploads::deleteMany([$settings->logo_path]);
            $data['logo_path'] = null;
        }

        if ($request->boolean('remove_banner')) {
            Uploads::deleteMany([$settings->banner_path]);
            $data['banner_path'] = null;
        }

        $newLogo = Uploads::storeOne($request->file('logo'), 'settings');
        if ($newLogo) {
            Uploads::deleteMany([$settings->logo_path]);
            $data['logo_path'] = $newLogo;
        }

        $newBanner = Uploads::storeOne($request->file('banner'), 'settings');
        if ($newBanner) {
            Uploads::deleteMany([$settings->banner_path]);
            $data['banner_path'] = $newBanner;
        }

        $settings->update($data);

        return redirect()->route('admin.settings.edit');
    }
}

