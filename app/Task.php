<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'comment',
        'problem_type_id', 'latitude1',
        'latitude2', 'longitude1', 'longitude2', 'creator_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public $appends = [
//        'coordinate', 'map_popup_content',
    ];

//    /**
//     * Get station name_link attribute.
//     *
//     * @return string
//     */
//    public function getNameLinkAttribute()
//    {
//        $title = __('app.show_detail_title', [
//            'name' => $this->name, 'type' => __('station.station'),
//        ]);
//        $link = '<a href="'.route('stations.show', $this).'"';
//        $link .= ' title="'.$title.'">';
//        $link .= $this->name;
//        $link .= '</a>';
//
//        return $link;
//    }

//    /**
//     * Station belongs to User model relation.
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function creator()
//    {
//        return $this->belongsTo(User::class);
//    }
//
//    /**
//     * Get station coordinate attribute.
//     *
//     * @return string|null
//     */
//    public function getCoordinateAttribute()
//    {
//        if ($this->latitude && $this->longitude) {
//            return $this->latitude.', '.$this->longitude;
//        }
//    }
//
//    /**
//     * Get station map_popup_content attribute.
//     *
//     * @return string
//     */
//    public function getMapPopupContentAttribute()
//    {
//        $mapPopupContent = '';
//        $mapPopupContent .= '<div class="my-2"><strong>'.__('station.name').':</strong><br>'.$this->name_link.'</div>';
//        $mapPopupContent .= '<div class="my-2"><strong>'.__('station.coordinate').':</strong><br>'.$this->coordinate.'</div>';
//
//        return $mapPopupContent;
//    }
    public function problemType()
    {
        return $this->hasOne(RoadProblemType::class,'id','problem_type_id');
    }
}

