<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author',
        'status',
        'slug',
        'excerpt',
        'featured_image',
        'tags',
        'views'
    ];

    protected $casts = [
        'tags' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Générer automatiquement le slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);

            // Gérer les doublons de slug
            $count = static::where('slug', 'LIKE', "{$post->slug}%")->count();
            if ($count > 0) {
                $post->slug = "{$post->slug}-" . ($count + 1);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = Str::slug($post->title);

                $count = static::where('slug', 'LIKE', "{$post->slug}%")
                              ->where('id', '!=', $post->id)
                              ->count();
                if ($count > 0) {
                    $post->slug = "{$post->slug}-" . ($count + 1);
                }
            }
        });
    }

    // Scope pour les posts publiés
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Accessor pour l'excerpt automatique
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }

        return Str::limit(strip_tags($this->content), 150);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The users that have liked the post.
     */
    public function likers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    /**
     * Get the comments for the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
