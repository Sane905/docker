<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Auth;
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $place = $request->place;
        $age = $request->age;
        $keyword = $request->keyword;
        $gender = $request->gender;
        $music = $request->music;

        

        if($request->has('keyword')){
            $profiles = Profile::keyword($keyword)->paginate(1);
        }elseif($request->has('age')&&$age!=('error')&&$request->has('place')&&$place!=('error')&&$request->has('gender')&&$request->has('music')&&$music!=('error')){

        $profiles = Profile::ageplacemusicgender($age,$place,$music,$gender)->paginate(1);
        }elseif($request->has('age')&&$age!=('error')&&$request->has('place')&&$place!=('error')&&$request->has('gender')){
            $profiles = Profile::ageplacegender($age,$place,$gender)->paginate(1);
        }elseif($request->has('music')&&$music!=('error')&&$request->has('age')&&$age!=('error')&&$request->has('gender')&&$place=('error')){
            $profiles = Profile::agemusicgender($age,$music,$gender)->paginate(1);
        }elseif($request->has('music')&&$music!=('error')&&$request->has('place')&&$place!=('error')&&$request->has('age')&&$age!=('error')&&empty($gender)){
            /**バグ */
            $profiles = Profile::placemusicage($place,$music,$age)->paginate(1);
        }elseif($request->has('music')&&$music!=('error')&&$request->has('place')&&$place!=('error')&&$age=('error')&&$request->has('gender')){
            $profiles = Profile::placemusicgender($place,$music,$gender)->paginate(1);
        }elseif($request->has('place')&&$place!=('error')&&$request->has('music')&&$music!=('error')&&empty($gender)&&$age=('error')){
            /**バグ */
            $profiles = Profile::placemusic($place,$music)->paginate(1);
        }elseif($request->has('age')&&$age!=('error')&&$request->has('music')&&$music!=('error')&&$place=('error')&&empty($gender)){
            
            $profiles = Profile::agemusic($age,$music)->paginate(1);
        }elseif($request->has('gender')&&$request->has('music')&&$music!=('error')&&$place=('error')&&$age=('error')){
                
                $profiles = Profile::gendermusic($gender,$music)->paginate(1);
        }elseif($request->has('age')&&$age!=('error')&&$request->has('gender')&&$place=('error')&&$music==('error')){
        
                $profiles = Profile::genderage($gender,$age)->paginate(1);
        }elseif($request->has('age')&&$age!=('error')&&$request->has('place')&&$place!=('error')&&empty($gender)&&$music==('error')){

            $profiles = Profile::ageplace($age,$place)->paginate(1);
        }elseif($request->has('place')&&$place!=('error')&&$request->has('gender')&&$age=('error')&&$music==('error')){
        
            $profiles = Profile::genderplace($gender,$place)->paginate(1);
        }elseif($request->has('age')&&$age!=('error')&&empty($gender)&&$place=('error')&&$music==('error')){
        
            $profiles = Profile::age($age)->paginate(1);
        }elseif($request->has('place')&&$place!=('error')&&empty($gender)&&$age=('error')&&$music==('error')){
        
            $profiles = Profile::place($place)->paginate(1);
        }elseif($request->has('gender')&&$age=('error')&&$place=('error')&&$music==('error')){
            
            $profiles = Profile::gender($gender)->paginate(1);
        }elseif($request->has('music')&&$music!=('error')&&$age=('error')&&$place=('error')&&empty($gender)){

            $profiles = Profile::music($music)->paginate(1);
        }else{
            $profiles = Profile::open()->paginate(1);

        }
        
        return view('band.index')->with(['keyword'=>$keyword,'profiles'=>$profiles]);

    }
}
