<?php

namespace App\Models;

use App\Jobs\MangoAddedMailJobs;
use App\Mail\MangoAddedMail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Mango extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'buy_date', 'source_area_id', 'total_kg', 'buying_price', 'selling_price'];

    public function sourceArea(){
        return $this->belongsTo(SourceArea::class);
    }

    protected static function boot()
    {
        parent::boot();
        if(Auth::check()){
            self::creating(function($model) {
                $model->uuid = (string) Str::uuid();
            });


            self::created(function($model) {
                dispatch(new MangoAddedMailJobs());
            });
        }

        static::addGlobalScope('sortByLatest', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }

}
