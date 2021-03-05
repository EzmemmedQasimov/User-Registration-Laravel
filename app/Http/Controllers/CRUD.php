<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CRUD extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function qeydiyyatgoster()
    {
        return view('qeydiyyat');
    }

    public function siyahigoster()
    {
        $users = DB::table('isciler')->get();
        return view('siyahi', compact('users'));
    }

    public function EmailCheck(Request $request)
    {
        $users = DB::table('isciler')->select('email')
            ->where('email', '=', $request->email)->get();
        return $users;
    }

    public function UserEditView(Request $request)
    {
        $users = DB::table('isciler')
            ->where('id', '=', $request->id)->get();
        return json_encode($users, JSON_UNESCAPED_UNICODE);
    }

    public function UserEdit(Request $request)
    {
        $affected = DB::table('isciler')
            ->where('id', $request->id)
            ->update(
                [
                    'adsoyad' => $request->adsoyad,
                    'vezife' => $request->vezife,
                    'maas' => $request->maas,
                    'av' => $request->av,
                    'muqmuddeti' => $request->muqmuddeti." ".date("H:i:s")
                ]
            );
        if ($affected) {
            return redirect('/siyahi')->with('message', "İşçi uğurla redaktə edildi");
        } else {
            return redirect('/siyahi')->with('message', "Əməliyyat uğursuz oldu!");
        }
    }

    public function qeydiyyat(Request $request)
    {
        $ins = DB::table('isciler')->insert(
            [
                'adsoyad' => $request->adsoyad,
                'vezife' => $request->vezife,
                'maas' => $request->maas,
                'sekil' => '/',
                'email' => $request->email,
                'av' => $request->av,
                'qeytarixi' => date("Y-m-d H:m:s"),
                'muqmuddeti' => date("Y-m-d H:m:s", strtotime("1 year")),
            ]
        );
        if ($ins) {
            return redirect('/qeydiyyat')->with('message', "İşçi uğurla əlavə edildi");
        } else {
            return redirect('/qeydiyyat')->with('message', "Əməliyyat uğursuz oldu!");
        }
    }
    public function UserDelete($id){
       $x =  DB::table('isciler')->where('id', '=', $id)->delete();
        if ($x) {
            return redirect('/siyahi')->with('message', "İşçi uğurla silindi");
        } else {
            return redirect('/siyahi')->with('message', "Əməliyyat uğursuz oldu!");
        }
    }
}
