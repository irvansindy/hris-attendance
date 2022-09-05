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
        $zk = new ZKTeco('192.168.1.200', 4370, 'TCP');
        // Karawang Office
        // $zk = new ZKTeco('192.168.10.4', 4370, 'TCP');
        // $zk = new ZKTeco('192.168.10.3', 4370, 'TCP');
        // Head Office
        // $zk = new ZKTeco('192.168.1.19', 4370, 'TCP');
        
        if ($zk->connect())
        {
            // $users = $zk->getUser();
            $attendance = $zk->getAttendance();
            // dd($attendance);
            $array_post=[];
            foreach($attendance as $item)
            {
                $created_at = strtotime($item['timestamp']);
                $array =[
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
        }
        else{
          dd('cant connect this ip');
        }

        
    
        return Helper::success(
            $array_post,
            'Data berhasil diambil'
        );
    }

    public function storeAttendance(){
        $zk = new ZKTeco('192.168.10.4', 4370, 'TCP');
        // $zk->connect();
        // $zk->disableDevice();
        
        if ($zk->connect())
        {
            // $users = $zk->getUser();
            $attendance = $zk->getAttendance();
            // dd($attendance);
            $array_post=[];
            foreach($attendance as $item)
            {
                // Sistem akan memvalidasi, jika data ada, maka data tersebut tidak di insert
              $validasi_1 = HrisAttendance::where('attend_date', $item['timestamp'])->where('created_by', $item['id'])->count();
              
              if($validasi_1 == 0 ){
                $created_at = strtotime($item['timestamp']);
                $array =[
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
            // dd($array_post);
            if($array_post !=null)
            {
                $insert = HrisAttendance::insert($array_post);
            }else{
                $insert ='Data tidak ada yang diimport';
            }
        }
        // dd($array_post);
        return Helper::success(
            $insert,
            'Data berhasil diimport ke db'
        );
    }
    public function all()
    {
        $get_data = HrisAttendance::all();
        return Helper::success(
            $get_data,
            'Berhasil get data'
        );
    }
}
