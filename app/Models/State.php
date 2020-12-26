<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\State
 *
 * @property int $id
 * @property string $name
 * @property string $acronym
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $country_id
 * @property-read Collection|City[] $cities
 * @property-read int|null $cities_count
 * @property-read Country $country
 * @method static Builder|State newModelQuery()
 * @method static Builder|State newQuery()
 * @method static Builder|State query()
 * @method static Builder|State whereAcronym($value)
 * @method static Builder|State whereCountryId($value)
 * @method static Builder|State whereCreatedAt($value)
 * @method static Builder|State whereId($value)
 * @method static Builder|State whereName($value)
 * @method static Builder|State whereUpdatedAt($value)
 * @mixin Eloquent
 */
class State extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'acronym',
        'country_id'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'country_id' => 'int'
    ];

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
