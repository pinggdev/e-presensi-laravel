<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoStorePresence extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presence:auto-store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto store presence data to database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Ambil seluruh user yang belum absen hari ini atau yang absennya tidak lengkap
        $users = User::where(function($query) {
            $query->whereDoesntHave('presences', function($q) {
                $q->whereDate('tanggal_presensi', Carbon::today());
            })->orWhereHas('presences', function($q) {
                $q->whereDate('tanggal_presensi', Carbon::today())
                  ->where(function($subQuery) {
                      $subQuery->whereNull('keterangan_masuk')
                               ->orWhereNull('keterangan_pulang');
                  });
            });
        })->get();
    
        // Simpan absen alpha untuk seluruh user yang tidak hadir hari ini
        if ($users->isEmpty()) {
            foreach(User::all() as $user) {
                $presence = new Presence([
                    'user_id' => $user->id,
                    'tanggal_presensi' => Carbon::today(),
                    'keterangan_masuk' => 'A',
                    'keterangan_pulang' => 'A',
                ]);
    
                $presence->save();
            }
        } else {
            // Update keterangan_pulang menjadi TAP jika keterangan_masuk tidak null dan keterangan_pulang masih null
            foreach($users as $user) {
                $presence = $user->presences()->whereDate('tanggal_presensi', Carbon::today())->first();
                if ($presence !== null && $presence->keterangan_masuk !== null && $presence->keterangan_pulang === null) {
                    $presence->keterangan_pulang = 'TAP';
                    $presence->save();
                } else if ($presence === null) {
                    $presence = new Presence([
                        'user_id' => $user->id,
                        'tanggal_presensi' => Carbon::today(),
                        'keterangan_masuk' => 'A',
                        'keterangan_pulang' => 'A',
                    ]);
    
                    $presence->save();
                }
            }
        }
    }    
}
