<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SchoolSetting extends Model
{
    protected $fillable = ['key', 'value'];

    protected $table = 'school_settings';

    /**
     * Get a setting value by key
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value by key
     */
    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Get all settings as key-value array
     */
    public static function getAllSettings(): array
    {
        return static::all()->pluck('value', 'key')->toArray();
    }

    /**
     * Get full URL for a photo setting with fallback
     */
    public static function getPhoto(string $key, ?string $defaultPath = null): string
    {
        $val = static::get($key);

        // Fallback khusus jika logo_path belum diisi tapi logo_maarif diunggah
        if (!$val && $key === 'logo_path') {
            $val = static::get('logo_maarif');
        }

        if ($val) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($val)) {
                return asset('storage/' . $val);
            }
            if (file_exists(public_path($val))) {
                return asset($val);
            }
        }

        return $defaultPath ? asset($defaultPath) : asset('images/logo-nu.png');
    }
}
