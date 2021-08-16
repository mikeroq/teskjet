<?php

namespace App\Services;

use App\Models\Navigation;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GenerateNavigationService
{
    public static function generate()
    {
        $navigation = Navigation::with(['children' => function($query) {
            $query->orderBy('order_column', 'ASC');}])->where('navigation_type_id', 1)->orderBy('order_column', 'ASC')->get();
        $admin_navigation = Navigation::with(['children' => function($query) {
            $query->orderBy('order_column', 'ASC');}])->where('navigation_type_id', 2)->orderBy('order_column', 'ASC')->get();
        $usercp_navigation = Navigation::with(['children' => function($query) {
            $query->orderBy('order_column', 'ASC');}])->where('navigation_type_id', 5)->orderBy('order_column', 'ASC')->get();
        try {
            Storage::disk('local')->put('navigation.json', $navigation->toJson(JSON_UNESCAPED_SLASHES));
            Storage::disk('local')->put('admin_navigation.json', $admin_navigation->toJson(JSON_UNESCAPED_SLASHES));
            Storage::disk('local')->put('usercp_navigation.json', $usercp_navigation->toJson(JSON_UNESCAPED_SLASHES));
            Log::info("Navigation generated");
        } catch (Exception $e) {
            Log::error("Navigation generation failed: $e");
        }
    }
}
