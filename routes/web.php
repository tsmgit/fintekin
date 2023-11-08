<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseMetaController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannermanagementController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\EnrollsController;
use App\Http\Controllers\Coursewiseearnings;
use App\Http\Controllers\Adminprofilemanagement;
use App\Http\Controllers\Instructorhelpsupport;
use App\Http\Controllers\Instructor;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\HelpsupportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::middleware('auth')->group(function () {
//     // Profile Routes
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('/course/{id}', [HomeController::class, "single_course"])->name("course.single");
Route::get('add_cart/{course_id}', [HomeController::class, "add_cart"])->name("add_cart");

Route::get('terms-and-conditions', [HomeController::class, "tc"])->name("tc");
Route::get('privacy-and-policy', [HomeController::class, "pp"])->name("pp");

Route::middleware('auth')->group(function () {
    Route::get("checkout/{course_id}", [OrderController::class, "checkout"])->name("checkout");
    Route::post("payment/{course_id}", [OrderController::class, "payment"])->name("payment");
    
    Route::post("paypal/payment/success", [OrderController::class, "payment_success"])->name("payment.success");
    Route::post("paypal/payment/cancel", [OrderController::class, "payment_cancel"])->name("payment.cancel");
    
    Route::get("purchase/{course_id}", [OrderController::class, "enroll"])->name("enroll");
   
    Route::get("enroll/{course_id}", [OrderController::class, "enroll"])->name("enroll");
    
    Route::get("study/{course_id}", [StudyController::class, "learn"])->name("study.learn");
    // Route::get("study/lesson/complete/{lesson_id}", [StudyController::class, "learn"])->name("study.learn");
    // Route::get("study/lesson/incomplete/{lesson_id}", [StudyController::class, "learn"])->name("study.learn");

    Route::get("home/my-courses/learning/", [HomeController::class, "learning"])->name("my_courses");

    Route::get('/profile', [HomeController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [HomeController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [HomeController::class, 'destroy'])->name('profile.destroy');

});


// Instructor Routes
Route::middleware('auth')->prefix("instructor")->group(function () {
    // Instructor Dashboard
    Route::get("/", [InstructorController::class, "dashboard"])->name("instructor.dashboard");
    Route::resource("help", Instructorhelpsupport::class);
    Route::resource("courseearn", Coursewiseearnings::class);
    Route::resource("enrolling", EnrollsController::class);
    Route::post("chatinsert", [Instructorhelpsupport::class, "insertchat"])->name("helpo.insert");
    Route::post("paymentadd", [InstructorController::class, "paymentmethodadd"])->name("instructor.paymentadd");
    Route::post("withdrawlrequest", [InstructorController::class, "withdraw"])->name("instructor.withdrawlrequest");
    
    // Category Routes
    Route::post("category/subcategories", [CategoryController::class, "get_subcategories"])->name("category.subcategories");
    Route::resource("category", CategoryController::class);
    Route::get("transactionhistories", [InstructorController::class, "transaction"])->name("instructor.transaction");
    // Course Routes
    Route::resource("course", CourseController::class);
    // Course Meta Routes
    Route::resource("coursemeta", CourseMetaController::class);

    // Curriculum Routes
    Route::post("curriculums/create-chapter", [CurriculumController::class, "create_chapter"])->name("curriculum.create_chapter");
    Route::post("curriculums/delete-chapter", [CurriculumController::class, "delete_chapter"])->name("curriculum.delete_chapter");

    Route::post("curriculums/create-lesson", [CurriculumController::class, "create_lesson"])->name("curriculum.create_lesson");
    Route::post("curriculums/delete-lesson", [CurriculumController::class, "delete_lesson"])->name("curriculum.delete_lesson");

    Route::post("curriculums/chapter/update-title", [CurriculumController::class, "update_chapter_title"])->name("curriculum.update_chapter_title");
    Route::post("curriculums/lessons/update-title", [CurriculumController::class, "update_lesson_title"])->name("curriculum.update_lesson_title");
    Route::post("curriculums/lessons/update-content", [CurriculumController::class, "update_lesson_content"])->name("curriculum.update_lesson_content");

    Route::resource("curriculums", CurriculumController::class);

    Route::get("earnings", [InstructorController::class, "earning"])->name("instructor.earning");
});


// Admin Routes
Route::get("/admin", function () {
    return view("admin.cms.create");
});

 Route::get('/terms', [CmsController::class, "terms"])->name('terms');
 Route::get('/privacy', [CmsController::class, "priv"])->name('privacy');
 Route::post('/addprivacy', [CmsController::class, "addprivacy"])->name('add.privacy');
 Route::post('/addterms', [CmsController::class, "addterms"])->name('add.terms');
 Route::resource("categories", CategoryController::class);
 Route::resource("banners", BannermanagementController::class);

 Route::middleware('auth')->prefix("admin")->group(function () {
    Route::resource("courses", CourseController::class);
    Route::resource("helps", HelpsupportController::class);
    Route::resource("adminprofile", Adminprofilemanagement::class);
    Route::resource("coursesinfo", AdminCourseController::class);
    Route::post('/addprivacy', [AdminCourseController::class, "updatecoursestat"])->name('stat.update');
    Route::post('/editphoto', [Adminprofilemanagement::class, "setpickphoto"])->name('adminprofile.setpic');

    Route::get("/get_students", [AdminController::class, "get_students"])->name("admin.get_students");
    Route::get("/get_instructors", [AdminController::class, "get_instructors"])->name("admin.get_instructors");

});

require __DIR__.'/auth.php';
