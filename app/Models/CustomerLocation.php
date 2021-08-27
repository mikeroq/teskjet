<?php

namespace App\Models;

use App\Traits\ConvertTimezone;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class CustomerLocation extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ConvertTimezone;
    use LogsActivity;

    protected $fillable = [
        'customer_id',
        'name',
        'address',
        'address_2',
        'city',
        'state',
        'zip',
        'phone',
    ];

//    protected $casts = [
//        'phone' => E164PhoneNumberCast::class.':US'
//    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

//    public function getPhoneAttribute($attribute): string
//    {
//        if ($attribute === null) {
//            return '';
//        }
//        return PhoneNumber::make($attribute, 'US')->formatNational();
//    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty();
    }
}
