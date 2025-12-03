<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = ['logo', 'banner_image', 'banner_tagline' , 'about_image', 'about_heading', 'about_description' , 'year_of_exp' ,  'mission_heading', 'mission_text',
    'vision_heading', 'vision_text',
    'team_heading', 'team_text'];
}
