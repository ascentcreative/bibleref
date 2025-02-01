<?php

namespace AscentCreative\BibleRef\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use Illuminate\Database\Eloquent\Model;

use AscentCreative\BibleRef\Parser;
use AscentCreative\BibleRef\Bible\Exceptions\BibleReferenceParserException;

class BibleRefController extends Controller
{

  public function parse(Request $request) {

        $brp = new Parser();

        try {

            $parsed = $brp->parseBibleRef($request->term);

            $result = array('result'=>'ok', 'data'=>$parsed);
            

        } catch (\Exception $e) {

            $result = array('result'=>'error', 'message'=>$e->getMessage());
            $parsed = null;

        }

        return response()->json($result);

  }

}
