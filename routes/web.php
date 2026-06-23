<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('projects.index');
    }
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('projects.index');
    })->name('dashboard');

    // Projects
    Route::resource('projects', ProjectController::class);

    // Issues
    Route::resource('projects.issues', IssueController::class)->shallow();

    // Issue AJAX endpoints
    // Route::post('projects/{project}/issues/{issue}/attach-tag', [IssueController::class, 'attachTag'])->name('issues.attachTag');
    // Route::post('projects/{project}/issues/{issue}/detach-tag', [IssueController::class, 'detachTag'])->name('issues.detachTag');
    // Route::post('projects/{project}/issues/{issue}/attach-user', [IssueController::class, 'attachUser'])->name('issues.attachUser');
    // Route::post('projects/{project}/issues/{issue}/detach-user', [IssueController::class, 'detachUser'])->name('issues.detachUser');
    // Route::get('projects/{project}/issues/{issue}/comments', [IssueController::class, 'loadComments'])->name('issues.loadComments');
    // Route::post('projects/{project}/issues/{issue}/comments', [IssueController::class, 'storeComment'])->name('issues.storeComment');
    // Route::delete('projects/{project}/issues/{issue}/comments/{commentId}', [IssueController::class, 'deleteComment'])->name('issues.deleteComment');
    // Route::get('projects/{project}/issues', [IssueController::class, 'index'])->name('projects.issues.index');

    Route::prefix('projects/{project}/issues')
    ->name('projects.issues.')
    ->controller(IssueController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::prefix('{issue}')->group(function () {
            Route::post('attach-tag', 'attachTag')->name('attachTag');
            Route::post('detach-tag', 'detachTag')->name('detachTag');

            Route::post('attach-user', 'attachUser')->name('attachUser');
            Route::post('detach-user', 'detachUser')->name('detachUser');

            Route::get('comments', 'loadComments')->name('comments.index');
            Route::post('comments', 'storeComment')->name('comments.store');
            Route::delete('comments/{commentId}', 'deleteComment')->name('comments.destroy');
        });
    });

    // Tags
    Route::resource('tags', TagController::class);

    // Comments (simple routes)
    Route::post('issues/{issue}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';

