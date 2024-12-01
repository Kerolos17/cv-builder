<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Image;
use App\Models\Info;
use App\Models\Lang;
use App\Models\Langleve;
use App\Models\Level;
use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class backendController extends Controller
{
    public function userCv (){
        return view('backend.basicinfo');
    }
    public function saveInfo (Request $request){
        Info::insert(
            [
                'user_id'=>Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city'=>$request->city,
            ]
            );
            $notification= array(
                'message'=>'Basic Info inserted Successfully',
                'alert-type'=>'success'
            );


        return redirect()->route('user.profile')->with('success',$notification);
    }
    public function userProfile(){

        return view('backend.profile');
    }
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function saveProfile(Request $request){
        Profile::insert([
            'user_id'=>Auth::user()->id,
            'desc'=>$request->desc,

        ]);
        $notification= array(
            'message'=>'Profile inserted Successfully',
            'alert-type'=>'success'
        );


    return redirect()->route('user.skills')->with($notification);
    }
    public function editProfile(){
        $profile=Profile::where('user_id',Auth::user()->id)->first();
        return view('backend.editprofile',compact('profile'));
    }
    public function updateProfile(Request $request){
        $id = $request->id;
        Profile::findOrFail($id)->update([
            'user_id'=>Auth::user()->id,
            'desc'=>$request->desc,

        ]);
        $notification= array(
            'message'=>'Profile Updated Successfully',
            'alert-type'=>'success'
        );


    return redirect()->route('user.profile')->with($notification);
    }
    public function editInfo(){
        $info=Info::where('user_id',Auth::user()->id)->first();
        return view('backend.editinfo',compact('info'));
    }
    public function updateInfo (Request $request){
        $id = $request->id;

        Info::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city'=>$request->city,
        ]);
            $notification= array(
                'message'=>'Basic Info updated Successfully',
                'alert-type'=>'success'
            );


        return redirect()->back()->with('success',$notification);
    }
    public function userSkills(){
        return view('backend.skill');
    }
    public function saveSkills (Request $request){

        Skill::insert([
            'user_id'=>Auth::user()->id,
           'skillName'=>$request->skillName,
        ]);
        $notification= array(
            'message'=>'Skills inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('user.edu')->with($notification);
    }
    public function editSkill(){
        $skill=Skill::where('user_id',Auth::user()->id)->first();
        $skillName = $skill->skillName;
        return view('backend.editskill',compact('skillName', 'skill'));
    }
    public function updateSkill(Request $request){
        $id = $request->id;
        Skill::findOrFail($id)->update([
            'user_id'=>Auth::user()->id,
           'skillName'=>$request->skillName,
        ]);
        $notification= array(
            'message'=>'Skills updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    public function userEducation(){
        $kinds = Level::all();
        return view('backend.edu', compact('kinds'));
    }
    public function saveEducation (Request $request){
        Education::insert([
            'user_id'=>Auth::user()->id,
            'level_id'=>$request->level_id,
            'eduName'=>$request->eduName,
            'startDate'=>$request->startDate,
            'endDate'=>$request->endDate,
            'filde'=>$request->filde,
            'desc'=>$request->desc,

        ]);
        $notification= array(
            'message'=>'Education inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    public function indexEducation(){
        $edus = Education::all();
        $kinds = Level::all();
        return view('backend.indexEdu', compact('edus','kinds'));
    }
    public function editEducation($id){
        // $edus = Education::find($id);
        $edus = Education::where('id' , $id)->first();
        $kinds = Level::all();
        return view('backend.editedu', compact('edus', 'kinds'));
    }
    public function updateEducation(Request $request){
        $id = $request->id;
        Education::findOrFail($id)->update([
            'level_id'=>$request->level_id,
            'eduName'=>$request->eduName,
            'startDate'=>$request->startDate,
            'endDate'=>$request->endDate,
            'filde'=>$request->filde,
            'desc'=>$request->desc,
        ]);
        $notification= array(
            'message'=>'Education updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('view.edu')->with($notification);
    }
    public function deleteEducation($id){
        // $edus = Education::find($id);
        Education::findOrFail($id)->delete();
        $notification= array(
            'message'=>'Education deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    public function userlang(){
        return view('backend.lang');
    }
    public function saveLang(Request $request){
        Lang::insert([
            'user_id'=>Auth::user()->id,
            'langName'=>$request->langName,
        ]);
        $notification= array(
            'message'=>'Languages inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('user.image')->with($notification);
    }
    public function editLang(){
        $lang=Lang::where('user_id',Auth::user()->id)->first();
        $langName = $lang->langName;
        return view('backend.editlang',compact('langName', 'lang'));
    }
    public function updateLang(Request $request){
        $id = $request->id;
        Lang::findOrFail($id)->update([
            'user_id'=>Auth::user()->id,
           'langName'=>$request->langName,
        ]);
        $notification= array(
            'message'=>'language updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    public function userImage(){
        return view('backend.image');
    }
    public function saveImage(Request $request)
    {
        if($request->file('img')){
            $manager = new ImageManager(new Driver());
            $img_name = hexdec(uniqid()) . '.' . $request->file('img')->getClientOriginalExtension();
            $img=$manager->read($request->file('img'));
            $img->resize(480,480);
            $img->toJpeg(80)->save(base_path('public/upload/' . $img_name));
            $url = 'upload/' . $img_name;
            Image::insert([
                'user_id'=>Auth::user()->id,
                'img'=>$url,
            ]);
            $notification= array(
                'message'=>'Image Uploaded Successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }

    }
    public function editImage(){
        $image=Image::where('user_id',Auth::user()->id)->first();
        return view('backend.editimage',compact('image'));
    }
    public function updateImage(Request $request){
        $id = $request->id;
        $old_img=$request->old_img;

        if($request->file('img')){
            $manager = new ImageManager(new Driver());
            $img_name = hexdec(uniqid()) . '.' . $request->file('img')->getClientOriginalExtension();
            $img=$manager->read($request->file('img'));
            $img->resize(480,480);
            $img->toJpeg(80)->save(base_path('public/upload/' . $img_name));
            $url = 'upload/' . $img_name;
            unlink(base_path('public/'. $old_img)); // remove old image
            Image::findOrFail($id)->update([
                'img'=>$url,
            ]);
            $notification= array(
                'message'=>'Image updated Successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
    }

}
public  function showCv(){
    $profile=Profile::where('user_id',Auth::user()->id)->first();
    $info=Info::where('user_id',Auth::user()->id)->first();
    $skills=Skill::where('user_id',Auth::user()->id)->get();
    $edus = Education::where('user_id', Auth::user()->id)->get();
    $edu = Education::where('user_id', Auth::user()->id)->first();
    $langs=Lang::where('user_id',Auth::user()->id)->get();
    $images=Image::where('user_id',Auth::user()->id)->first();
    return view('backend.cv', compact('profile','info','skills','edus','edu','langs','images'));
}
}


