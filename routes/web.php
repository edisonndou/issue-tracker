<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    if (auth()->check()) {
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
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // Issues
    Route::resource('projects.issues', IssueController::class)->shallow();

    // Issue AJAX endpoints
    Route::post('projects/{project}/issues/{issue}/attach-tag', [IssueController::class, 'attachTag'])->name('issues.attachTag');
    Route::post('projects/{project}/issues/{issue}/detach-tag', [IssueController::class, 'detachTag'])->name('issues.detachTag');
    Route::post('projects/{project}/issues/{issue}/attach-user', [IssueController::class, 'attachUser'])->name('issues.attachUser');
    Route::post('projects/{project}/issues/{issue}/detach-user', [IssueController::class, 'detachUser'])->name('issues.detachUser');
    Route::get('projects/{project}/issues/{issue}/comments', [IssueController::class, 'loadComments'])->name('issues.loadComments');
    Route::post('projects/{project}/issues/{issue}/comments', [IssueController::class, 'storeComment'])->name('issues.storeComment');
    Route::delete('projects/{project}/issues/{issue}/comments/{commentId}', [IssueController::class, 'deleteComment'])->name('issues.deleteComment');
    Route::get('projects/{project}/issues', [IssueController::class, 'index'])->name('projects.issues.index');

    // Tags
    Route::resource('tags', TagController::class);
    Route::delete('tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

    // Comments (simple routes)
    Route::post('issues/{issue}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';

