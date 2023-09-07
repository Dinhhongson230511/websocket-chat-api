<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Food as FoodTypes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'furigana',
        'post_code',
        'prefecture',
        'prefecture_id',
        'area',
        'sub_area',
        'sub_area_id',
        'address_lines',
        'tel',
        'fax',
        'email',
        'lat',
        'long',
        'max_people',
        'smoking_policy',
        'parking',
        'parking_remarks',
        'boarding_place',
        'cp',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    //--------- RELATIONS ---------//
    public function storeImages(): HasMany
    {
        return $this->hasMany(StoreImage::class, 'store_id', 'id');
    }

    public function allergyCompatibilities(): BelongsToMany
    {
        return $this->belongsToMany(AllergyCompatibility::class, 'store_allergy_compatibility', 'store_id', 'allergy_compatibility_id');
    }

    public function dietaryRestrictions(): BelongsToMany
    {
        return $this->belongsToMany(DietaryRestriction::class, 'store_dietary_restriction', 'store_id', 'dietary_restriction_id');
    }

    public function roomSeatTypes(): BelongsToMany
    {
        return $this->belongsToMany(RoomSeatType::class, 'store_room_seat_types', 'store_id', 'room_seat_type_id');
    }

    // relationship of stores to days tables, this is holidays of stores
    public function storeHolidays(): BelongsToMany
    {
        return $this->belongsToMany(Day::class, 'holiday_store', 'store_id', 'day_id');
    }

    public function getSubCartegoryNameAttribute()
    {
        return $this->dishes;
    }

    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class, 'store_dish', 'store_id', 'dish_id');
    }

    public function subCategories(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'store_sub_category', 'store_id', 'sub_category_id');
    }

    public function holidays(): HasMany
    {
        return $this->hasMany(Holiday::class);
    }

    public function businessHours(): HasMany
    {
        return $this->hasMany(BusinessHour::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'food_store', 'store_id', 'food_id');
    }

    public function foodsTypeMain()
    {
        return $this->foods()->where('food_type_id', FoodTypes::TYPE_MAIN);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function prefectures(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class, 'prefecture_id', 'id');
    }

    public function subAreas(): BelongsTo
    {
        return $this->belongsTo(SubArea::class);
    }

    public function channels(): HasMany
    {
        return $this->hasMany(Channel::class, 'store_id', 'id');
    }

    /**
     * Get all users who like this store
     *
     * @return BelongsToMany
     */
    public function likedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'store_id', 'user_id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    //--------- SCOPES ---------//
    /**
     * Scope a query stores.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  Object $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchStores($query, $request)
    {
        if (!!$request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if (!!$request->max_people) {
            $query->where('max_people', '>=', $request->max_people);
        }

        if (!!$request->smoking_policy) {
            $smokingPolicy = explode(',', $request->smoking_policy);
            $query->whereIn('smoking_policy', $smokingPolicy);
        }

        if (!!$request->parking) {
            $parking = explode(',', $request->parking);
            $query->whereIn('parking', $parking);
        }

        if (!!$request->time) {
            $time = $request->time;
            $query->whereHas('businessHours', function ($q) use ($time) {
                $q->where('start_time', '<=', $time)->where('end_time', '>=', $time);
            });
        }

        if (!!$request->date) {
            $date = $request->date;
            $query->whereHas('holidays', function ($q) use ($date) {
                $q->where('start_time', '<=', $date)
                    ->where('end_time', '>=', $date);
            });
        }

        if (!!$request->dishes_ids) {
            $dishIds = json_decode($request->dishes_ids);
            $query->whereHas('dishes', function ($q) use ($dishIds) {
                $q->whereIn('id', $dishIds);
            });
        }

        if (!!$request->sub_categories_ids) {
            $dishIds = json_decode($request->sub_categories_ids);
            $query->whereHas('subCategories', function ($q) use ($dishIds) {
                $q->whereIn('id', $dishIds);
            });
        }

        if (!!$request->allergy_compatibility_ids) {
            $allergyCompatibilityIds = json_decode($request->allergy_compatibility_ids);
            $query->whereHas('allergyCompatibilities', function ($q) use ($allergyCompatibilityIds) {
                $q->whereIn('id', $allergyCompatibilityIds);
            });
        }

        if (!!$request->dietary_restriction_ids) {
            $dietaryRestrictionIds = json_decode($request->dietary_restriction_ids);
            $query->whereHas('dietaryRestrictions', function ($q) use ($dietaryRestrictionIds) {
                $q->whereIn('id', $dietaryRestrictionIds);
            });
        }

        if (!!$request->type_seat_ids) {
            $typeSeatIds = json_decode($request->type_seat_ids);
            $query->whereHas('roomSeatTypes', function ($q) use ($typeSeatIds) {
                $q->whereIn('id', $typeSeatIds);
            });
        }

        if (!!$request->area_ids) {
            $areaIds = json_decode($request->area_ids);
            $query->whereIn('sub_area_id', $areaIds);
        }

        if (!!$request->prefecture_id) {
            $query->where('prefecture_id', $request->prefecture_id);
        }

        //filter current user favorite stores
        if (filter_var($request->my_favorite, FILTER_VALIDATE_BOOLEAN)) {
            $query->whereHas('likedByUsers', function ($q) {
                $q->where('user_id', auth()->user()->id);
            });
        }

        //filter current user company favorite stores
        if (filter_var($request->member_favorite, FILTER_VALIDATE_BOOLEAN)) {
            $query->whereHas('likedByUsers', function ($q) {
                $q->whereIn('user_id', function ($p) {
                    $p->select('id')
                        ->from('users')
                        ->where('travel_agency_id', auth()->user()->travel_agency_id);
                });
            });
        }

        return $query;
    }
}
