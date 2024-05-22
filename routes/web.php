<?php

use App\Livewire\ArticleKits;
use App\Livewire\Employee;
use App\Livewire\Encaissement;
use App\Livewire\ErrorPage;
use App\Livewire\Vente;
use App\Livewire\Vente2;
use App\Livewire\Vente3;
use Illuminate\Support\Facades\Route;

use App\Livewire\Articles;
use App\Livewire\Articles\EditArticle;

use App\Livewire\Clients;
use App\Livewire\Clients\EditClients;
use App\Livewire\Dashboard;
use App\Livewire\ManageSupplier;
use App\Livewire\Suppliers\EditSupplier;

use App\Livewire\Items;

use App\Livewire\DashboardAdminComponent;
use App\Livewire\Depenses;
use App\Livewire\DepenseCategorie;
use App\Livewire\ListVente;
use App\Livewire\StockEntry;
use App\Livewire\Ventes;

// use App\Livewire\Services\ManageSuppliers;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
// // Route::get('/manage-suppliers', ManageSuppliers::class)->name('manage.suppliers');
// Route::get('/clients', Clients::class)->name('clients');

// }
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // // Route::get('/admin/dashboard', function () {
    // //     return ;
    // // })->name('admin_dashboard');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/home', function () {
        return redirect('/dashboard');
    });
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get('/admin/dashboard', function () {
        return redirect('/dashboard');
    });

    // Route::get('/admin/dashboard', DashboardAdminComponent::class)->name('admin_dashboard');

    Route::get('/clients', Clients::class)->name('clients');
    Route::get('/clients/edit/{ClientId}', EditClients::class)->name('client.edit');

    Route::get('/suppliers', ManageSupplier::class)->name('suppliers');
    Route::get('/suppliers/edit/{supplierId}', EditSupplier::class)->name('supplier.edit');

    Route::get('/employee', Employee::class)->name('employee');

    Route::get('/depenses', Depenses::class)->name('depenses');

    Route::get('/depenseCategory', DepenseCategorie::class)->name('depensesCategorie');

    Route::get('/articles', Articles::class)->name('articles');
    Route::get('/articles/edit/{item_id}', EditArticle::class)->name('article.edit');
    
    Route::get('/articlesEnKits', ArticleKits::class)->name('articlesEnKits');

    Route::get('/articlesEnKits2', \App\Livewire\Services\ArticleKits::class)->name('articlesEnKits');
    
    Route::get('/vente', Vente::class)->name('vente');
    Route::get('/listVente', Vente::class)->name('listVente');
    
    // Route::get('/vente2', Ventes::class)->name('vente2');
    
    // Route::get('/vente2', Vente2::class)->name('listVente');
    
    // Route::get('/vente3', Vente3::class)->name('vente3');
    
    Route::get('/entrerStock', StockEntry::class)->name('StockEntry');
    
    Route::get('/encaissement ', Encaissement::class)->name('Encaissement');

    Route::get('/error', ErrorPage::class)->name('errorPage');

    // Route::group(['permission:create Fournisseurs|delete Fournisseurs|update Fournisseurs|read Fournisseurs'], function () {
    //     Route::get('/suppliers', ManageSupplier::class)->name('suppliers');
    // });

    // Route::group(['permission:create Employés|delete Employés|update Employés|read Employés'], function () {
    //     Route::get('/employes', Employee::class)->name('employee');
    // });
});
