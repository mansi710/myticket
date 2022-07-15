<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\TicketsRaisedController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestQueueEmails;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//--------------------- ROLE WISED CHECKING  -----------------
Route::get('/dashboard', function () {
    return redirect()->route('tickets.index');
})->middleware(['auth','user'])->name('dashboard');


Route::get('/admin_dashboard', function () {
    return redirect()->route('adminTicketList');
})->middleware(['auth','admin'])->name('admin_dashboard');




//--------------------- FOR CHANGING PASSWORD IN FRONT SIDE -----------------
Route::get('change-password',[ChangePasswordController::class,'index'])->name('changePassword.index');

Route::post('change-password', [ChangePasswordController::class,'store'])->name('change.password');




//--------------------- TICKETS RAISED BY USER -----------------
// Route::get('ticket-raised-by-user',[TicketsRaisedController::class,'create'])->name('ticket.view');

// Route::post('ticket-create',[TicketsRaisedController::class,'store'])->name('ticket.created');

//--------------------- TICKETS OPERATION DONE BY ADMIN ----------------- 

// Route::get('listing-tickets',[TicketController::class,'index'])->name('ticket.listing');
// Route::get('ticket-raised-by-user',[TicketController::class,'create'])->name('ticket.view');

// Route::post('ticket-create',[TicketController::class,'store'])->name('ticket.created');
// Route::resource('ticket_urls',AdminTicketController::class);

//--------------------- FOR TICKET OPRATIONS -----------------
Route::resource('tickets',TicketController::class)->middleware(['auth']);
//--------------------- FOR COMMENT -----------------

Route::resource('comments',CommentController::class);

//--------------------- FOR NOTIFICATION LIST AND MARKED READ -----------------

Route::resource('notifications',NotificationController::class);

Route::get('getAllNotifications',[NotificationController::class,'index'])->name('getListOfNotifications');

Route::get('markAsRead/{id}',[NotificationController::class,'show'])->name('markAsRead');
// Route::get('getNotifications',[NotificationController::class,'notifications'])->name('notification.list');

// Route::get('readNotification/{id}',[NotificationController::class,'readNotification'])->name('notification.read');


Route::get('profileAdmin',[ProfileController::class,'profile'])->name('profilePage')->middleware('auth');

Route::get('adminList',[TicketController::class,'indexAdmin'])->name('adminTicketList')->middleware('admin');

Route::get('search',[TicketController::class,'search'])->name('search');





Route::get('sending-queue-emails', [TestQueueEmails::class,'sendTestEmails']);


Route::get('send/mail', [TestQueueEmails::class, 'send_mail'])->name('send_mail');
require __DIR__.'/auth.php';
