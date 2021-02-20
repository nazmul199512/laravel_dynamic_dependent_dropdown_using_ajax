<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

/**
 * Class DynamicDependent
 * @package App\Http\Controllers
 * @author MD. Nazmul Alam <nazmul199512@gmail.com>
 */
class DynamicDependent extends Controller
{
    function index()
    {
        $country_list = DB::table('country')
            ->groupBy('country')
            ->get();
        return view('dependent')->with('country_list', $country_list);
    }

    function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('country')
            ->where($select, $value)
            ->groupBy($dependent)
            ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }
}
