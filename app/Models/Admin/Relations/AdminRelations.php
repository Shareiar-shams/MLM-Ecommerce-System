<?php

namespace App\Models\Admin\Relations;

trait AdminRelations
{
     // Optional helper to fetch only this admin's activities
    public function activities()
    {
        return $this->hasMany(\Spatie\Activitylog\Models\Activity::class, 'causer_id')
                    ->where('causer_type', self::class);
    }
}