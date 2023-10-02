<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Hash;
use App\Models\Filemaker\FMMemberEdit;
use App\Models\Filemaker\FMMemberList;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use GearboxSolutions\EloquentFileMaker\Support\Facades\FM;

class SyncWithMembrum implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void {}

    public static function syncFromFMMemberEdit()
    {
        $limit = 10;
        $offset = 0;
        $list = FMMemberList::limit($limit)->offset($offset)->get();
        while(!empty($list)) {
            foreach ($list as $item) {
                if (empty($item['member_no']) || $item['member_no'] == "" || $item['member_no'] < 1) {
                    continue;
                }
                $member = FMMemberEdit::where('id', $item['id'])->first()?->toArray();
                if ($member) {
                    $member['created_at'] = Carbon::createFromFormat("m/d/Y", $member['created_at'], "Europe/Stockholm");
                    $member['updated_at'] = Carbon::createFromFormat("m/d/Y", $member['updated_at'], "Europe/Stockholm");
                    $member['yearly_fee'] = empty($member['yearly_fee']) ? 0 : $member['yearly_fee'];
                    $profile = Profile::upsert(array_intersect_key($member, array_flip(Profile::$fm_fields)), ['member_no'], Profile::$fm_fields);
                    $member['password'] = Hash::make(Str::random(24));
                    $member['profile_id'] = $item['id'];
                    $member['member_no'] = $item['id'];
                    $user_id = User::upsert(array_intersect_key($member, array_flip(\array_merge(User::$fm_fields, ['password', 'profile_id', 'member_no']))), ['id'], User::$fm_fields);
                }


            }
            $offset += $limit;
            $list = FMMemberList::limit($limit)->offset($offset)->get();
        }
    }
}
