<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter as Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;
use App\Models\HrisAttendance;

class ApiHrisController extends Controller
{
    public function getAttendance(Request $request)
    {
        // T8 Office
        // $zk = new ZKTeco('192.168.1.200', 4370, 'TCP');
        // Cimanggis
        // $zk = new ZKTeco('192.168.2.01', 4370, 'TCP');
        // Karawang Office
        $zk = new ZKTeco('192.168.10.4', 4370, 'TCP');
        // $zk = new ZKTeco('192.168.10.3', 4370, 'TCP');
        // Head Office
        // $zk = new ZKTeco('192.168.1.19', 4370, 'TCP');
        
        if ($zk->connect())
        {
            // $users = $zk->getUser();
            $attendance = $zk->getAttendance();
            // dd($attendance);
            // dd($attendance);
            $array_post=[];
            foreach($attendance as $item)
            {
                $created_at = date('YmdHis',$item['timestamp']);
                dd($created_at);
                $array = [
                    'attendanceid'=>$item['uid'],
                    'attenddata'=>$item['id'],
                    // 'state'=>$item['state'],
                    'attend_date'=>$item['timestamp'],
                    'day'=>date('d',$created_at),
                    'month'=>date('m',$created_at),
                    'year'=>date('Y',$created_at),
                    'hour'=>date('H',$created_at),
                    'minute'=>date('i',$created_at),
                    'second'=>date('s',$created_at),
                    'status'=>$item['type'],
                    'machineno'=>1,
                    'machine_code'=>1,
                    'uploadstatus'=>1,
                    'company_id'=>1,
                    'remark'=>1,
                    'photo'=>'',
                    'geolocation'=>'',
                    'att_on'=>1,
                    'created_by'=>'ICT',
                    'modified_by'=>'-',
                    'modified_date'=>'',
                    'created_date'=>date('Y-m-d H:i:s'),

                ];
                array_push($array_post,$array);
            }
            return Helper::success(
                $array_post,
                'Data berhasil diambil'
            );
        }
        else{
            return Helper::error(
                NULL,
                'Gagal untuk koneksi ke IP',
                500
            );
        }
    }
    // port 03
    public function storeAttendanceKarawang(){
        $zk = new ZKTeco('192.168.10.3', 4370, 'TCP');
        
        if ($zk->connect())
        {
            $attendance = $zk->getAttendance();
            $array_post=[];
            foreach($attendance as $item)
            {
            // Sistem akan memvalidasi, jika data ada, maka data tersebut tidak di insert
            $validasi_1 = HrisAttendance::where('attend_date', $item['timestamp'])->where('created_by', $item['id'])->count();
                if($validasi_1 == 0 ){
                    $created_at = strtotime($item['timestamp']);
                    $formatDate = date('YmdHis',$created_at);
                    $array =[
                        'attendanceid'=>$item['uid'],
                        'attenddata'=>$item['id'].$formatDate,
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
                        'geolocation'=>'KARAWANG',
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
                $insert = HrisAttendance::insertOrIgnore($array_post);
                return Helper::success(
                    $insert,
                    'Data berhasil di-import ke Database'
                );
            } else {
                return Helper::error(
                    NULL,
                    'Data gagal diimport ke Database',
                    404
                );
            }
        } else {
            return Helper::error(
                NULL,
                'Gagal untuk koneksi ke IP',
                500
            );
        }
    }
// Karawang
    // port 04
    public function storeAttendanceKarawang2(){
        $zk = new ZKTeco('192.168.10.4', 4370, 'TCP');
        
        if ($zk->connect())
        {
            $attendance = $zk->getAttendance();
            $array_post=[];
            foreach($attendance as $item)
            {
            // Sistem akan memvalidasi, jika data ada, maka data tersebut tidak di insert
            $validasi_1 = HrisAttendance::where('attend_date', $item['timestamp'])->where('created_by', $item['id'])->count();
                if($validasi_1 == 0 ){
                    $created_at = strtotime($item['timestamp']);
                    $formatDate = date('YmdHis',$created_at);
                    $array =[
                        'attendanceid'=>$item['uid'],
                        'attenddata'=>$item['id'].$formatDate,
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
                        'geolocation'=>'KARAWANG',
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
                $insert = HrisAttendance::insertOrIgnore($array_post);
                return Helper::success(
                    $insert,
                    'Data berhasil di-import ke Database'
                );
            } else {
                return Helper::error(
                    NULL,
                    'Data gagal diimport ke Database',
                    404
                );
            }
        } else {
            return Helper::error(
                NULL,
                'Gagal untuk koneksi ke IP',
                500
            );
        }
    }
// T8
        public function storeAttendanceT8(){
            $zk = new ZKTeco('192.168.1.200', 4370, 'TCP');
            
            if ($zk->connect())
            {
                $attendance = $zk->getAttendance();
                $array_post=[];
                foreach($attendance as $item)
                {
                // Sistem akan memvalidasi, jika data ada, maka data tersebut tidak di insert
                $validasi_1 = HrisAttendance::where('attend_date', $item['timestamp'])->where('created_by', $item['id'])->count();
                    if($validasi_1 == 0 ){
                        $created_at = strtotime($item['timestamp']);
                        $formatDate = date('YmdHis',$created_at);
                        $array =[
                            'attendanceid'=>$item['uid'],
                            'attenddata'=>$item['id'].$formatDate,
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
                            'geolocation'=>'T8',
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
                    $insert = HrisAttendance::insertOrIgnore($array_post);
                    return Helper::success(
                        $insert,
                        'Data berhasil di-import ke Database'
                    );
                } else {
                    return Helper::error(
                        NULL,
                        'Data gagal diimport ke Database',
                        404
                    );
                }
            } else {
                return Helper::error(
                    NULL,
                    'Gagal untuk koneksi ke IP',
                    500
                );
            }
        }
// HO
        public function storeAttendanceHO(){
            $zk = new ZKTeco('192.168.1.19', 4370, 'TCP');
            
            if ($zk->connect())
            {
                $attendance = $zk->getAttendance();
                $array_post=[];
                foreach($attendance as $item)
                {
                // Sistem akan memvalidasi, jika data ada, maka data tersebut tidak di insert
                $validasi_1 = HrisAttendance::where('attend_date', $item['timestamp'])->where('created_by', $item['id'])->count();
                    if($validasi_1 == 0 ){
                        $created_at = strtotime($item['timestamp']);
                        $formatDate = date('YmdHis',$created_at);
                        $array =[
                            'attendanceid'=>$item['uid'],
                            'attenddata'=>$item['id'].$formatDate,
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
                            'geolocation'=>'HO',
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
                    $insert = HrisAttendance::insertOrIgnore($array_post);
                    return Helper::success(
                        $insert,
                        'Data berhasil di-import ke Database'
                    );
                } else {
                    return Helper::error(
                        NULL,
                        'Data gagal diimport ke Database',
                        404
                    );
                }
            } else {
                return Helper::error(
                    NULL,
                    'Gagal untuk koneksi ke IP',
                    500
                );
            }
}
// Cimanggis


    public function all()
    {
        $get_data = HrisAttendance::all();
        return Helper::success(
            $get_data,
            'Berhasil get data'
        );
    }
}
