<?php

namespace Database\Seeders;

use App\Models\AttachmentType;
use App\Models\FollowUpNotificationAttachment;
use Illuminate\Database\Seeder;

class AttachmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (FollowUpNotificationAttachment::INFOS as $key => $value) {
            AttachmentType::create([
                'name' => $value['label'],
                'info' => $key
            ]);
        }
    }
}
