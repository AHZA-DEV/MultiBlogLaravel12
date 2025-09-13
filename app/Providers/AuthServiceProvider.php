<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Admin can do everything
        Gate::before(function (User $user, string $ability) {
            if ($user->role === 'admin') {
                return true;
            }
        });

        // Users can only edit their own posts
        Gate::define('edit-post', function (User $user, Post $post) {
            return $user->id === $post->author_id;
        });

        // Users can only edit their own tags
        Gate::define('edit-tag', function (User $user, Tag $tag) {
            return $user->id === $tag->created_by;
        });

        // Only admins can manage categories
        Gate::define('manage-categories', function (User $user) {
            return $user->role === 'admin';
        });

        // Only admins can manage users
        Gate::define('manage-users', function (User $user) {
            return $user->role === 'admin';
        });
    }
}