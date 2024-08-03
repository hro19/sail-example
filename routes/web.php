<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\MailController;
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

Route::get('/', [RecipeController::class, 'home'])->name('recipe.home');

Route::resource('students', StudentController::class);

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipe.index');
Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipe.create');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipe.show');
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipe.store');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipe.destroy');

Route::get('/sending', [MailController::class, 'send']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
