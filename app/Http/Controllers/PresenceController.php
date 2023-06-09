<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Presence;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $presences = Presence::all();
        return view('user.presence.index', compact('presences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // mengambil data dari API ip-api.com
        $json = file_get_contents('http://ip-api.com/json/');
        // konversi JSON menjadi array asosiatif
        $data = json_decode($json, true);
        // mengembalikan alamat IPv4

        // Mendapatkan lokasi berdasarkan alamat IP
        $location = Location::get($data['query']);
        $kantor_latitude = -7.53306;
        $kantor_longitude = 110.596;
        $user_latitude = Location::get($data['query'])->latitude;
        $user_longitude = Location::get($data['query'])->longitude;
        
        $earth_radius = 6371; // Earth's radius in km
        $delta_latitude = deg2rad($kantor_latitude - $user_latitude);
        $delta_longitude = deg2rad($kantor_longitude - $user_longitude);
        $a = sin($delta_latitude / 2) * sin($delta_latitude / 2) + cos(deg2rad($user_latitude)) * cos(deg2rad($kantor_latitude)) * sin($delta_longitude / 2) * sin($delta_longitude / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earth_radius * $c; // Distance between the two points in km

        $max_distance = 2001.0; // Maximum distance in km

        $userId = Auth::user()->id;
        $tanggal = date('Y-m-d');
        
        $checkIn = Presence::where('user_id', $userId)
                        ->where('tanggal_presensi', $tanggal)
                        ->whereNotNull('check_in_time')
                        ->first();
        if ($checkIn) {
            $keteranganMasuk = $checkIn->keterangan_masuk;
        } else {
            $keteranganMasuk = '';
        }
        $checkOut = Presence::where('user_id', $userId)
                        ->where('tanggal_presensi', $tanggal)
                        ->whereNotNull('check_out_time')
                        ->first();
        if ($checkOut) {
            $keteranganPulang = $checkIn->keterangan_pulang;
        } else {
            $keteranganPulang = '';
        }
        // dd(Location::get($data['query']));
        
        // if ($distance <= $max_distance) {
        // return "berhasil";
        // } else {
        // return "gagal";
        // }
        return view('user.presence.form', compact(['checkIn', 'checkOut', 'distance', 'max_distance', 'keteranganMasuk', 'keteranganPulang']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'keterangan_masuk' => 'required',
        ]);
        
        $presence = new Presence([
            'user_id' => $request->get('user_id'),
            'tanggal_presensi' => now()->toDateString(),
            'check_in_time' => $request->get('check_in_time'),
            'keterangan_masuk' => $request->get('keterangan_masuk'),
        ]);

        $presence->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presence $presence)
    {
        $request->validate([
            'keterangan_pulang' => 'required',
        ]);
        $presence->check_out_time = $request->check_out_time;
        $presence->keterangan_pulang = $request->keterangan_pulang;

        $presence->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bynamedata()
    {
        // Mendapatkan user id yang sedang login
        $userId = Auth::user()->id;

        // Mendapatkan data presensi berdasarkan user_id
        $presences = Presence::where('user_id', $userId)->get();

        // Mengembalikan data presensi ke view
        return view('user.presence.bynamedata', compact('presences'));
    }

    public function bymonthdata(Request $request)
    {
        $month = $request->input('month');
        $userId = Auth::user()->id;

        if ($month) {
            $presences = Presence::where('user_id', $userId)
                ->whereMonth('tanggal_presensi', $month)
                ->get();
            return view('user.presence.bymonthdata', compact('presences', 'month'));
        } else {
            $presences = Presence::where('user_id', $userId)
                ->get();
            return view('user.presence.bymonthdata', compact('presences' ,'month'));
        }
    }

    public function dataguru(Request $request)
    {
        $username = $request->input('name');
        
        // mengambil user berdasarkan nama
        $user = User::where('name', $username)->first();
    
        if ($user) {
            $presences = Presence::where('user_id', $user->id)->get();
            return view('user.presence.dataguru', compact('presences', 'username'));
        } else {
            $presences = Presence::all();
            return view('user.presence.dataguru', compact('presences' ,'username'));
        }
    }
    
     

    public function pdfbyname()
    {
        // Mendapatkan user id yang sedang login
        $userId = Auth::user()->id;
    
        // Mendapatkan data presensi berdasarkan user_id
        $presences = Presence::where('user_id', $userId)->get()->toArray();
    
        $pdf = Pdf::loadView('user.presence.pdf.byname', ['presences' => $presences]);
        return $pdf->download('data-absen-saya.pdf');
    }

    public function pdfbymonth($month = '')
    {
        $userId = Auth::user()->id;
    
        if($month == '') {
            $presences = Presence::where('user_id', $userId)
            ->get()->toArray();
            
            $pdf = Pdf::loadView('user.presence.pdf.bymonth', ['presences' => $presences]);
            return $pdf->download('data-absen-bulanan-saya.pdf');
        } else {
            $presences = Presence::where('user_id', $userId)
            ->whereMonth('tanggal_presensi', $month)
            ->get()->toArray();
            
            $pdf = Pdf::loadView('user.presence.pdf.bymonth', ['presences' => $presences]);
            return $pdf->download('data-absen-bulanan-saya.pdf');
        }
    }

    public function pdfdataguru($username = '')
    {
        $user = User::where('name', $username)->first();
    
        if($username == '') {
            $presences = Presence::join('users', 'users.id', '=', 'presences.user_id')
            ->select('presences.*', 'users.name')
            ->get()
            ->toArray();

            
            $pdf = Pdf::loadView('user.presence.pdf.datagurupdf', ['presences' => $presences], ['username' => $username]);
            return $pdf->download('data-absen-guru.pdf');
        } else {
            $presences = Presence::where('user_id', $user->id)
            ->join('users', 'users.id', '=', 'presences.user_id')
            ->select('presences.*', 'users.name')
            ->get()
            ->toArray();
            // ->get()->toArray();
            
            $pdf = Pdf::loadView('user.presence.pdf.datagurupdf', ['presences' => $presences], ['username' => $username]);
            return $pdf->download('data-absen-guru.pdf');
        }
    }
    
    
}
