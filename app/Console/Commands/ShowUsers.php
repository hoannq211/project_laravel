<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ShowUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:show-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hiển Thị danh sách người dùng';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all(['id','name']);
          if ($users->isEmpty()) {
            $this->info('Không có người dùng nào.');
            return;
        }

        // Hiển thị dưới dạng bảng
        $this->table(
            ['ID', 'Tên', 'Email'],
            $users->toArray()
        );
    }
}
