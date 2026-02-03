<?php

use App\Http\Controllers\Admin\BrokerVerificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AgentController as AdminAgentController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Broker\DashboardController as BrokerDashboardController;
use App\Http\Controllers\Broker\PropertyController as BrokerPropertyController;
use App\Http\Controllers\Broker\ReservationController as BrokerReservationController;
use App\Http\Controllers\Broker\PaymentController as BrokerPaymentController;
use App\Http\Controllers\ChatController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;




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



Route::get('/send-test-email', function(Request $request) {
    $to = 'Abdulrahman.Eid@vadecom.net';
    $subject = 'Test Email from Laravel';
    $messageText = $request->input('message', 'Hello! This is a test email.');

    try {
        // إعداد SwiftMailer مباشر
        $transport = new \Swift_SmtpTransport('mail.alsalmatravel.com', 465, 'ssl');
        $transport->setUsername('info@alsalmatravel.com');
        $transport->setPassword('FJLyDuO3kxyf2026'); // كلمة السر الجديدة

        $mailer = new \Swift_Mailer($transport);

        $messageObj = (new \Swift_Message($subject))
            ->setFrom(['info@alsalmatravel.com' => 'Alsalma Travel'])
            ->setTo([$to])
            ->setBody('<p>'.$messageText.'</p>', 'text/html');

        $mailer->send($messageObj);

        return response()->json([
            'status' => 'success',
            'message' => 'Email sent successfully!'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to send email',
            'error' => $e->getMessage()
        ]);
    }
});

Route::get('/',[HomeController::class, 'index'])->name('home.index');
Route::post('/search',[HomeController::class,'filterProperties'])->name('home.search');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/autocomplete', [ProjectController::class, 'autocomplete'])->name('projects.autocomplete');
Route::get('/projects/{idOrSlug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/property/{id}', [HomeController::class, 'propertyDetails'])->name('property.show');
Route::get('/properties', [\App\Http\Controllers\propertyController::class, 'leftSidebar'])->name('properties.leftSidebar');
Route::post('/reservations', [\App\Http\Controllers\ReservationController::class, 'store'])->name('reservations.store');
Route::get('/blog/{slug}', [HomeController::class, 'blogDetails'])->name('blog.show');
Route::get('/Properties/{id}',[HomeController::class,'propertiesByCategory'])->name('category.properties');
Route::get('çontact-us', [HomeController::class, 'contactUs'])->name('contact.index');
Route::get('/blogs',[HomeController::class,'blogs'])->name('blogs.index');
Route::post('çontact-us', [HomeController::class, 'sendContactMessage'])->name('contact.send');
Route::get('/language/{locale}', function ($locale) {
    if (! in_array($locale, ['ar', 'en'], true)) {
        $locale = config('app.locale', 'ar');
    }

    session(['locale' => $locale]);

    return redirect()->back();
})->name('language.switch');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/messages', [ChatController::class, 'list'])->name('chat.messages');
    Route::post('/chat/messages', [ChatController::class, 'store'])->name('chat.store');
    
    // Chat Status & Tickets
    Route::get('/chat/status', [ChatController::class, 'checkStatus'])->name('chat.status');
    Route::post('/tickets', [App\Http\Controllers\TicketController::class, 'store'])->name('tickets.store');
});



Route::prefix('{locale}/admin')
    ->whereIn('locale', ['ar', 'en'])
    ->as('admin.')
    ->middleware(['setlocale', 'auth', 'role:admin'])
    ->group(function () {
    // 🏠 Dashboard

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 📂 Categories CRUD
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // 🏢 Properties CRUD
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::post('/properties/{id}/approve', [PropertyController::class, 'approve'])->name('properties.approve');
    Route::post('/properties/{id}/reject', [PropertyController::class, 'reject'])->name('properties.reject');

    // 🏗 Projects CRUD
    Route::get('/projects', [AdminProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [AdminProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [AdminProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}/edit', [AdminProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}', [AdminProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [AdminProjectController::class, 'destroy'])->name('projects.destroy');


    // 🏢 PropertiesType CRUD

    Route::get('property-types', [PropertyTypeController::class, 'index'])->name('property-types.index');
    Route::get('property-types/create', [PropertyTypeController::class, 'create'])->name('property-types.create');
    Route::post('property-types/store', [PropertyTypeController::class, 'store'])->name('property-types.store');
    Route::get('property-types/{id}/edit', [PropertyTypeController::class, 'edit'])->name('property-types.edit');
    Route::put('property-types/{id}/update', [PropertyTypeController::class, 'update'])->name('property-types.update');
    Route::delete('property-types/{id}/destroy', [PropertyTypeController::class, 'destroy'])->name('property-types.destroy');

    Route::get('broker-verifications', [BrokerVerificationController::class, 'index'])->name('broker-verifications.index');
    Route::post('broker-verifications/{id}/approve', [BrokerVerificationController::class, 'approve'])->name('broker-verifications.approve');
    Route::post('broker-verifications/{id}/reject', [BrokerVerificationController::class, 'reject'])->name('broker-verifications.reject');
    Route::delete('broker-verifications/{id}', [BrokerVerificationController::class, 'destroy'])->name('broker-verifications.destroy');

    // Users & Brokers
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Reservations / Leads
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::post('reservations/{id}/status', [ReservationController::class, 'changeStatus'])->name('reservations.change-status');

    // Payments
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    // Features
    Route::get('features', [FeatureController::class, 'index'])->name('features.index');
    Route::get('features/create', [FeatureController::class, 'create'])->name('features.create');
    Route::post('features', [FeatureController::class, 'store'])->name('features.store');
    Route::get('features/{id}/edit', [FeatureController::class, 'edit'])->name('features.edit');
    Route::put('features/{id}', [FeatureController::class, 'update'])->name('features.update');
    Route::delete('features/{id}', [FeatureController::class, 'destroy'])->name('features.destroy');

    // 👥 Agents CRUD
    Route::get('agents', [AdminAgentController::class, 'index'])->name('agents.index');
    Route::get('agents/create', [AdminAgentController::class, 'create'])->name('agents.create');
    Route::post('agents', [AdminAgentController::class, 'store'])->name('agents.store');
    Route::get('agents/{id}/edit', [AdminAgentController::class, 'edit'])->name('agents.edit');
    Route::put('agents/{id}', [AdminAgentController::class, 'update'])->name('agents.update');
    Route::delete('agents/{id}', [AdminAgentController::class, 'destroy'])->name('agents.destroy');

    // 📝 Blogs CRUD
    Route::get('blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
    Route::get('blogs/create', [AdminBlogController::class, 'create'])->name('blogs.create');
    Route::post('blogs', [AdminBlogController::class, 'store'])->name('blogs.store');
    Route::get('blogs/{id}/edit', [AdminBlogController::class, 'edit'])->name('blogs.edit');
    Route::put('blogs/{id}', [AdminBlogController::class, 'update'])->name('blogs.update');
    Route::delete('blogs/{id}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');

    // Settings
    Route::get('site-settings', [\App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::put('site-settings', [\App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('site-settings.update');

    // Messages
    Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class)->only(['index']);

    // Tickets
    Route::get('tickets', [App\Http\Controllers\Admin\TicketController::class, 'index'])->name('tickets.index');
    Route::post('tickets/{id}/reply', [App\Http\Controllers\Admin\TicketController::class, 'reply'])->name('tickets.reply');

    Route::get('chats', [AdminChatController::class, 'index'])->name('chats.index');
    Route::get('chats/messages', [AdminChatController::class, 'list'])->name('chats.messages');
    Route::post('chats/messages', [AdminChatController::class, 'store'])->name('chats.store');
});

// Backward compatible admin routes without locale -> redirect to default locale
// Exclude /admin/login so that guest admin login works correctly
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/{any?}', function () {
        $locale = config('app.locale', 'ar');
        $path = request()->path(); // e.g. admin/dashboard
        $suffix = str_replace('admin', '', $path);
        return redirect("/{$locale}/admin{$suffix}");
    })->where('any', '^(?!login$).*');
});

// للـ broker فقط
Route::prefix('{locale}/broker')
    ->whereIn('locale', ['ar', 'en'])
    ->as('broker.')
    ->middleware(['setlocale', 'auth', 'role:broker'])
    ->group(function () {
        Route::get('/dashboard', [BrokerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/properties', [BrokerPropertyController::class, 'index'])->name('properties.index');
        Route::get('/properties/create', [BrokerPropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [BrokerPropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/{id}/edit', [BrokerPropertyController::class, 'edit'])->name('properties.edit');
        Route::put('/properties/{id}', [BrokerPropertyController::class, 'update'])->name('properties.update');
        Route::get('/reservations', [BrokerReservationController::class, 'index'])->name('reservations.index');
        Route::get('/payments', [BrokerPaymentController::class, 'index'])->name('payments.index');
    });

Route::middleware(['auth', 'role:broker'])->group(function () {
    Route::get('/broker/kyc', [\App\Http\Controllers\BrokerKycController::class, 'show'])->name('broker.kyc');
    Route::post('/broker/kyc', [\App\Http\Controllers\BrokerKycController::class, 'store'])->name('broker.kyc.submit');
});

// للمستخدمين العاديين أو أي دور تاني
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/properties/create', [\App\Http\Controllers\propertyController::class, 'create'])->name('user.properties.create');
    Route::post('/properties', [\App\Http\Controllers\propertyController::class, 'store'])->name('user.properties.store');
});

// لو عايز تسمح بأكثر من دور
Route::middleware(['auth', 'role:admin,broker'])->group(function () {
});


// Auth routes are defined in auth.php (Breeze) to avoid duplication.

require __DIR__ . '/auth.php';
