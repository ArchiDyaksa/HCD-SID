<?php

namespace App\Traits;

use App\Models\DesaProfile;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToDesa
{
    protected static function bootBelongsToDesa(): void
    {
        static::creating(function ($model) {
            if (empty($model->desa_profile_id)) {
                $desa = DesaProfile::current();
                if ($desa && $desa->id) {
                    $model->desa_profile_id = $desa->id;
                }
            }
        });

        static::addGlobalScope('desa_scope', function (Builder $builder) {
            $desa = DesaProfile::current();
            if ($desa && $desa->id) {
                $builder->where($builder->getQuery()->from . '.desa_profile_id', $desa->id);
            }
        });
    }

    public function desaProfile()
    {
        return $this->belongsTo(DesaProfile::class, 'desa_profile_id');
    }
}
