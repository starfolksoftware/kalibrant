<?php

namespace StarfolkSoftware\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'setable_type',
        'setable_id',
        'group',
        'key',
        'value',
    ];

    /**
     * Determines if migrations should be run.
     * 
     * @var bool
     */
    public static $shouldRunMigrations = true;

    /**
     * Get the parent setable model.
     */
    public function setable()
    {
        return $this->morphTo();
    }

    /**
     * Get attributes in group
     * 
     * @param string $setableType
     * @param int $setableId
     * @param string $group
     * 
     * @return array
     */
    public static function attributesInGroup(string $setableType, int $setableId, string $group)
    {
        $setable = (new $setableType)::find($setableId);
        
        return $setable->settings()
            ->forGroup($group)
            ->get(['key', 'value'])
            ->mapWithKeys(function ($object) {
                return [$object->name => json_decode($object->payload, true)];
            })->toArray();
    }

    /**
     * Ignores migrations.
     * 
     * @return void
     */
    public static function ignoreMigrations()
    {
        static::$shouldRunMigrations = false;
    }
}