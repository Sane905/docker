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

        

       if($place==('error')&&empty($keyword)&&$age==('error')&&empty($gender)&&$music==('error')){
            $profiles = Profile::open()->paginate(6);
       }elseif($request->has('keyword')){
            
            $query = Profile::keyword();
            $profiles = $query->paginate(6);
        }elseif($request->has('age')&&$age!=('error')&&$request->has('place')&&$place!=('error')&&$request->has('gender')&&$request->has('music')&&$music!=('error')){
        $query->Where('age',$age)
        ->Where('place',$place)
        ->Where('music','LIKE',"%{$music}%")
        ->Where('gender',$gender);

        $profiles = $query->paginate(6);
        }elseif($request->has('age')&&$age!=('error')&&$request->has('place')&&$place!=('error')&&$request->has('gender')){
            $query->Where('age',$age)
                    ->Where('place',$place)
                    ->Where('gender',$gender);

                $profiles = $query->paginate(6);
            

            
        }elseif($request->has('music')&&$music!=('error')&&$request->has('age')&&$age!=('error')&&$request->has('gender')&&$place=('error')){
            $query->Where('age',$age)
            ->Where('music','LIKE',"%{$music}%")
            ->Where('gender',$gender);
            $profiles = $query->paginate(6);
        }elseif($request->has('music')&&$music!=('error')&&$request->has('place')&&$place!=('error')&&$age=('error')&&$request->has('gender')){
            $query->Where('place',$place)
            ->Where('music','LIKE',"%{$music}%")
            ->Where('gender',$gender);
            $profiles = $query->paginate(6);
        }elseif($request->has('music')&&$music!=('error')&&$request->has('place')&&$place!=('error')&&$request->has('age')&&$age!=('error')&&empty($gender)){
            $query->Where('place',$place)
            ->Where('music','LIKE',"%{$music}%")
            ->Where('age',$age);
            $profiles = $query->paginate(6);
        }elseif($request->has('music')&&$music!=('error')&&$request->has('place')&&$place!=('error')&&empty($gender)&&$age=('error')){
            $query->Where('place',$place)
            ->Where('music','LIKE',"%{$music}%");
            $profiles = $query->paginate(6);
        }elseif($request->has('age')&&$age!=('error')&&$request->has('music')&&$music!=('error')&&$place=('error')&&empty($gender)){
            $query->Where('age',$age)
            ->Where('music','LIKE',"%{$music}%");
            $profiles = $query->paginate(6);
        }elseif($request->has('gender')&&$request->has('music')&&$music!=('error')&&$place=('error')&&$age=('error')){
                $query->Where('gender',$gender)
                ->Where('music','LIKE',"%{$music}%");
                $profiles = $query->where('user_id' ,'<>' , Auth::id())->paginate(6);
        }elseif($request->has('age')&&$age!=('error')&&$request->has('gender')&&$place=('error')&&$music==('error')){
                $query->Where('gender',$gender)
                ->Where('age',$age);
                $profiles = $query->paginate(6);
        }elseif($request->has('age')&&$age!=('error')&&$request->has('place')&&$place!=('error')&&empty($gender)&&$music==('error')){
            $query->Where('age',$age)
            ->Where('place',$place);

            $profiles = $query->paginate(6);
        }elseif($request->has('place')&&$place!=('error')&&$request->has('gender')&&$age=('error')&&$music==('error')){
            $query->Where('gender',$gender)
            ->Where('place',$place);
            $profiles = $query->paginate(6);
        }elseif($request->has('age')&&$age!=('error')&&empty($gender)&&$place=('error')&&$music==('error')){
            $query->Where('age',$age);
            $profiles = $query->paginate(6);
        }elseif($request->has('place')&&$place!=('error')&&empty($gender)&&$age=('error')&&$music==('error')){
            $query->Where('place',$place);
            $profiles = $query->paginate(6);
        }elseif($request->has('gender')&&$age=('error')&&$place=('error')&&$music==('error')){
            $query->Where('gender',$gender);
            $profiles = $query->paginate(6);
        }elseif($request->has('music')&&$music!=('error')&&$age=('error')&&$place=('error')&&empty($gender)){
            $query->Where('music','LIKE',"%{$music}%");
            $profiles = $query->paginate(6);
        }else{
            $profiles = Profile::open()->paginate(6);

        }
        
        return view('band.index')->with(['keyword'=>$keyword,'profiles'=>$profiles]);

    }
}
