<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MasterSetting
 * @package App\Models
 * @method static Builder|static byKey(string $key)
 */
class MasterSetting extends Model
{
    use HasFactory;

    const KEY_PASSWORD = 'origin_password';
    const KEY_BACKUP_PASSWORD = 'backup_password';

    protected $table = "master_settings";

    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * Directly where to a specific key
     * @param Builder $query
     * @param string $key
     * @return Builder|static
     */
    public function scopeByKey(Builder $query, string $key): Builder
    {
        return $query->where('key', $key);
    }

    /**
     * Check if the application is ready to use
     * @return bool
     */
    public static function isApplicationReady(): bool
    {
        $requiredSettings = [
            MasterSetting::KEY_PASSWORD,
            MasterSetting::KEY_BACKUP_PASSWORD
        ];

        return MasterSetting::query()
            ->whereIn('key', $requiredSettings)
            ->count('id') == count($requiredSettings);
    }
}
