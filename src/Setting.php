<?php

namespace StarfolkSoftware\Kalibrant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * StarfolkSoftware\Kalibrant\Setting
 *
 * @property string $setable_type
 * @property mixed $setable_id
 * @property string $group
 * @property string $key
 * @property mixed $value
 */
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
        $setable = (new $setableType())::find($setableId);

        return $setable->settings()
            ->whereGroup($group)
            ->get(['key', 'value'])
            ->mapWithKeys(function ($object) {
                return [$object->key => json_decode($object->value, true)];
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
