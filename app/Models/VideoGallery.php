<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoGallery extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'video_id',
        'thumb',
        'status',
        'is_front'
    ];
    
    protected $casts = [
        'is_front' => 'boolean',
    ];
    
    // Generate YouTube thumbnail URL from video_id
    public function getYoutubeThumbnailAttribute()
    {
        return "https://img.youtube.com/vi/{$this->video_id}/maxresdefault.jpg";
    }
    
    // Generate YouTube embed URL
    public function getYoutubeEmbedUrlAttribute()
    {
        return "https://www.youtube.com/embed/{$this->video_id}";
    }
    
    // Generate YouTube watch URL
    public function getYoutubeWatchUrlAttribute()
    {
        return "https://www.youtube.com/watch?v={$this->video_id}";
    }
    
    // Scope for active videos
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    
    // Scope for front page videos
    public function scopeFront($query)
    {
        return $query->where('is_front', true);
    }
}
