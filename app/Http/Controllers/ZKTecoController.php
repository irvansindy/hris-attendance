<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;
use App\Models\HrisAttendance;
use App\Helpers\ResponseFormatter as HelperResponseAPI;

class ZKTecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zk = new ZKTeco('192.168.10.4', 4370, 'TCP');
        // $zk->connect();
        // $zk->disableDevice();
        
        if ($zk->connect()){
            // $users = $zk->getUser();
            $attendance = $zk->getAttendance();
            $array = [];
            $array_post = [];
            foreach($attendance as $item)
            {
                $validasi_1 = HrisAttendance::where('attend_date', $item['timestamp'])->where('created_by', $item['id'])->count();
                if($validasi_1 == 0) {
                    $created_at = strtotime($item['timestamp']);
                    
                    $array = [
                        'attendanceid'=>$item['uid'],
                        'attenddata'=>$item['id'].$created_at,
                        // 'state'=>$item['state'],
                        'attend_date'=>$item['timestamp'],
                        'day'=>date('d',$created_at),
                        'month'=>date('m',$created_at),
                        'year'=>date('Y',$created_at),
                        'hour'=>date('H',$created_at),
                        'minute'=>date('i',$created_at),
                        'second'=>date('s',$created_at),
                        'status'=>$item['type'],
                        'machineno'=>0,
                        'machine_code'=>'FINGERPRINT',
                        'uploadstatus'=>1,
                        'company_id'=>1,
                        'remark'=>1,
                        'photo'=>'',
                        'geolocation'=>'',
                        'att_on'=>1,
                        'created_by'=>$item['id'],
                        'modified_by'=>$item['id'],
                        'modified_date'=>date('Y-m-d H:i:s'),
                        'created_date'=>date('Y-m-d H:i:s'),
                    ];
                    array_push($array_post,$array);
                }
            }

            if($array_post != NULL) {
                // dd($array_post);
                $insert = HrisAttendance::insertOrIgnore($array_post);
                return HelperResponseAPI::success(
                    $insert,
                    'Data berhasil diimport ke Database'
                );
            } else {
                return HelperResponseAPI::error(
                    NULL,
                    'Data gagal diimport ke Database',
                    404
                );
            }
            // return view('vendor.zkteco.absensi', ['users' => $users]);
            return view('vendor.zkteco.attendance', ['attendances' => $attendance]);
        } elseif ($zk->disconnect()) {
            return HelperResponseAPI::error(
                NULL,
                'Gagal untuk koneksi ke IP',
                500
            );
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
}
