<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton( // CategoryRepository
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepositoryEloquent::class,
        );
        $this->app->singleton( // MajorRepository
            \App\Repositories\Major\MajorRepositoryInterface::class,
            \App\Repositories\Major\MajorRepositoryEloquent::class,
        );
        $this->app->singleton( // BookRepository
            \App\Repositories\Book\BookRepositoryInterface::class,
            \App\Repositories\Book\BookRepositoryEloquent::class,
        );
        $this->app->singleton( // BorrowPayRepository
            \App\Repositories\Borrowpay\BorrowpayRepositoryInterface::class,
            \App\Repositories\Borrowpay\BorrowpayRepositoryEloquent::class,
        );
        $this->app->singleton( // StudentRepository
            \App\Repositories\Student\StudentRepositoryInterface::class,
            \App\Repositories\Student\StudentRepositoryEloquent::class,
        );
        $this->app->singleton( // AdminRepository - staff
            \App\Repositories\Admin\AdminRepositoryInterface::class,
            \App\Repositories\Admin\AdminRepositoryEloquent::class,
        );
        $this->app->singleton( // RoleRepository
            \App\Repositories\Role\RoleRepositoryInterface::class,
            \App\Repositories\Role\RoleRepositoryEloquent::class,
        );
        $this->app->singleton( // PermissionRepository
            \App\Repositories\Permission\PermissionRepositoryInterface::class,
            \App\Repositories\Permission\PermissionRepositoryEloquent::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Dùng phân trang của bootstrap - links()
        PaginationPaginator::useBootstrap();
    }
}
