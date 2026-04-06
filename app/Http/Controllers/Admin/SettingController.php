<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Display settings page
     */
    public function index()
    {
        $groups = [
            'contact' => 'Contact Information',
            'social' => 'Social Media Links',
        ];

        $settingsByGroup = [];
        foreach (array_keys($groups) as $group) {
            $settingsByGroup[$group] = Setting::where('group', $group)
                ->orderBy('order')
                ->get();
        }

        return view('admin.settings.index', compact('groups', 'settingsByGroup'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string|max:1000',
        ]);

        foreach ($request->settings as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        // Clear settings cache
        Cache::forget('site_settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }

    /**
     * Get all settings (for API/helper)
     */
    public function getAllSettings()
    {
        return Cache::remember('site_settings', 3600, function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }
}
