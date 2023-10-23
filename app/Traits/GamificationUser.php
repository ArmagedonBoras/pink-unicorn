<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Gamification\Point;
use App\Models\Gamification\Achievement;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait GamificationUser
{
    /**
     * Gamification methods
     */

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }

    public function awarded_by(): HasMany
    {
        return $this->hasMany(Achievement::class, 'awarded_by');
    }

    public function updatePoints()
    {
        $this->points = $this->pointsForYear(Carbon::now()->year);
        $this->all_time_points = $this->pointsForYear();
        $this->save();
    }

    public function pointsForYear(int $year = 0): int
    {
        if ($year == 0) {
            return $this->achievements()->sum('points');
        } else {
            return $this->achievements()->whereYear('created_at', $year)->sum('points');
        }

    }

    public function pointsForType(Point $point, int $year = 0): int
    {
        if ($year == 0) {
            return $this->achievements()->where('point_id', $point->id)->sum('points');
        } else {
            return $this->achievements()->where('point_id', $point->id)->whereYear('created_at', $year)->sum('points');
        }
    }

    public function pointsFromAwarded_by(User $awarded_by, int $year = 0): int
    {
        if ($year == 0) {
            return $this->achievements()->where('awarded_by', $awarded_by->id)->sum('points');
        } else {
            return $this->achievements()->where('awarded_by', $awarded_by->id)->whereYear('created_at', $year)->sum('points');
        }
    }

    public function awardedPoints()
    {
        return $this->awarded_by()->sum('points');
    }

    public function awardedPointsByUser()
    {
        $points = [];
        foreach ($this->awarded_by as $item) {
            $points[$item->user_id] = (isset($points[$item->user_id])) ? $points[$item->user_id] + $item->points : $item->points;
        }
        return $points;
    }

    public function awardedPointsByType()
    {
        $points = [];
        foreach ($this->awarded_by as $item) {
            $points[$item->point_id] = (isset($points[$item->point_id])) ? $points[$item->point_id] + $item->points : $item->points;
        }
        return $points;
    }

    public function pointsByType()
    {
        $points = [];
        foreach ($this->achievements as $item) {
            $points[$item->point_id] = (isset($points[$item->point_id])) ? $points[$item->point_id] + $item->points : $item->points;
        }
        return $points;
    }

    public function pointsByAwarder()
    {
        $points = [];
        foreach ($this->achievements as $item) {
            $points[$item->awarded_by] = (isset($points[$item->awarded_by])) ? $points[$item->awarded_by] + $item->points : $item->points;
        }
        return $points;
    }
}
