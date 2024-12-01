<?php

use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Backend routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/', [frontendController::class, 'index'])->name('home');
Route::controller(backendController::class)->group(function()
{
    Route::get('/user/logout','UserLogout' )->name('user.logout');
    Route::get('/user/cv',  'UserCv')->name('usercv');
    Route::post('/save/info','saveInfo' )->name('save.info');
    Route::get('/edit/info','editInfo' )->name('edit.info');
    Route::put('/update/info','updateInfo' )->name('update.info');


    Route::get('/user/profile',  'UserProfile')->name('user.profile');
    Route::post('/save/profile','saveProfile' )->name('save.profile');
    Route::get('/edit/profile','editProfile' )->name('edit.profile');
    Route::put('/update/profile','updateProfile' )->name('update.profile');


    Route::get('/user/skills','userSkills' )->name('user.skills');
    Route::post('/save/skill','saveSkills' )->name('save.skill');
    Route::get('/edit/skill','editSkill' )->name('edit.skill');
    Route::post('/update/skill','updateSkill' )->name('update.skill');


    Route::get('/user/edu','userEducation')->name('user.edu');
    Route::post('/save/edu','saveEducation' )->name('save.edu');
    Route::get('/veiw/edu','indexEducation' )->name('view.edu');
    Route::get('/edit/edu/{id}','editEducation' )->name('edit.edu');
    Route::post('/update/edu','updateEducation')->name('update.edu');
    Route::get('/edit/delete/{id}','deleteEducation' )->name('delete.edu');

    Route::get('/user/lang','userlang')->name('user.lang');
    Route::post('/save/lang','saveLang' )->name('save.lang');
    Route::get('/edit/lang','editLang' )->name('edit.lang');
    Route::post('/update/lang','updateLang')->name('update.lang');

    Route::get('/user/image','userImage')->name('user.image');
    Route::post('/save/image','saveImage' )->name('save.image');
    Route::get('/edit/image','editImage' )->name('edit.image');
    Route::post('/update/image','updateImage')->name('update.image');

    Route::get('/cv','showCv')->name('cv');

});


require __DIR__.'/auth.php';
