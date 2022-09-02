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
            $insert = HrisAttendance::insert($array_post);
        }
        return Helper::success(
            $insert,
            'Data berhasil diimport ke db'
        );
    }
}
