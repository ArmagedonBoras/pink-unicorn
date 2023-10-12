<?php

namespace App\Models;

use App\Models\User;
use App\Filters\CommentFilters;
use Wildside\Userstamps\Userstamps;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Database\Eloquent\Model;
use VStelmakh\UrlHighlight\UrlHighlight;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use VStelmakh\UrlHighlight\Highlighter\HtmlHighlighter;

class Comment extends Model
{
    use Userstamps;
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'title',
        'body',
        'type',
        'pinned',
        'expire_at',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    protected $with = [
        'author',
        'editor',
        'destroyer'
    ];
    protected $casts = [
        'expire_at' => 'date:Y-m-d',
        'pinned' => 'boolean',
    ];

    public function getBodyAttribute($body)
    {
        return Purify::clean($body);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeFilter($query, CommentFilters $filters)
    {
        return $filters->apply($query, ($this->type === 'info') ? ['expire_from' => date('Y-m-d')] : []);
    }

    public function getHtmlBody()
    {
        $highlighter = new HtmlHighlighter(
            'https', // string - scheme to use for urls matched by top level domain
            ['target' => '_blank'],     // string[] - key/value map of tag attributes, e.g. ['rel' => 'nofollow', 'class' => 'light']
            '',     // string - content to add before highlight: {here}<a...
            ''      // string - content to add after highlight: ...</a>{here}
        );
        $urlHighlight = new UrlHighlight(null, $highlighter);
        return nl2br($urlHighlight->highlightUrls($this->body));
    }

    public static function firstBodyByType(string $type): string
    {
        return self::where('type', $type)->first()?->getHtmlBody() ?? '';
    }
}
