<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users and create category first
        $adminUser = User::where('email', 'admin@example.com')->first();
        $regularUser = User::where('email', 'user@example.com')->first();
        
        // Create categories
        $techCategory = Category::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'description' => 'Latest technology trends and insights',
            'created_by' => $adminUser->id
        ]);
        
        $businessCategory = Category::create([
            'name' => 'Business',
            'slug' => 'business', 
            'description' => 'Business strategies and market insights',
            'created_by' => $adminUser->id
        ]);
        
        // Create tags
        $webTag = Tag::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'description' => 'Web development tutorials and tips',
            'created_by' => $adminUser->id
        ]);
        
        $laravelTag = Tag::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
            'description' => 'Laravel framework tutorials',
            'created_by' => $adminUser->id
        ]);
        
        $startupTag = Tag::create([
            'name' => 'Startup',
            'slug' => 'startup',
            'description' => 'Startup insights and advice',
            'created_by' => $regularUser->id
        ]);
        
        // Create sample posts
        $post1 = Post::create([
            'title' => 'Getting Started with Laravel 12: A Complete Guide',
            'slug' => 'getting-started-laravel-12-complete-guide',
            'excerpt' => 'Learn how to build modern web applications with Laravel 12. This comprehensive guide covers everything from installation to deployment.',
            'content' => "# Getting Started with Laravel 12: A Complete Guide

Laravel 12 brings exciting new features and improvements that make web development even more enjoyable. In this comprehensive guide, we'll explore everything you need to know to get started with Laravel 12.

## What's New in Laravel 12

Laravel 12 introduces several groundbreaking features:

- **Enhanced Performance**: Up to 30% faster response times
- **Improved Eloquent ORM**: Better relationship handling and query optimization
- **Advanced Blade Components**: More powerful and flexible templating
- **Built-in Authentication**: Streamlined auth system with role-based access

## Installation

Getting started with Laravel 12 is easier than ever:

```bash
composer create-project laravel/laravel my-app
cd my-app
php artisan serve
```

## Key Features

### 1. Eloquent Relationships
Laravel's Eloquent ORM makes database relationships intuitive:

```php
class User extends Model
{
    public function posts()
    {
        return \$this->hasMany(Post::class);
    }
}
```

### 2. Blade Templating
Create beautiful, maintainable templates:

```php
@extends('layouts.app')

@section('content')
    <h1>{{ \$title }}</h1>
    <p>{{ \$content }}</p>
@endsection
```

### 3. Artisan Commands
Powerful CLI for rapid development:

```bash
php artisan make:controller PostController
php artisan make:model Post -m
php artisan migrate
```

## Best Practices

1. **Follow MVC Pattern**: Keep your code organized
2. **Use Service Classes**: Extract business logic
3. **Implement Caching**: Improve performance
4. **Write Tests**: Ensure code quality

## Conclusion

Laravel 12 is the perfect framework for building modern web applications. With its elegant syntax, powerful features, and extensive ecosystem, you'll be building amazing applications in no time.

Start your Laravel journey today and join millions of developers who trust Laravel for their web development needs!",
            'author_id' => $adminUser->id,
            'category_id' => $techCategory->id,
            'status' => 'published',
            'views' => 1250,
            'published_at' => now()->subDays(2),
        ]);
        
        $post2 = Post::create([
            'title' => 'Building Modern Web Applications with Bootstrap 5',
            'slug' => 'building-modern-web-applications-bootstrap-5',
            'excerpt' => 'Discover how Bootstrap 5 revolutionizes front-end development with its utility-first approach and improved components.',
            'content' => "# Building Modern Web Applications with Bootstrap 5

Bootstrap 5 has transformed how we approach front-end development. With its utility-first classes and improved component system, creating responsive, beautiful web applications has never been easier.

## Why Bootstrap 5?

Bootstrap 5 brings several key improvements:

- **Utility Classes**: Rapid prototyping and styling
- **Custom CSS Properties**: Better theming support
- **Improved Grid System**: More flexible layouts
- **No jQuery Dependency**: Lighter and faster

## Getting Started

Include Bootstrap 5 in your project:

```html
<link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
```

## Key Components

### 1. Cards
Create beautiful content containers:

```html
<div class=\"card\">
    <div class=\"card-body\">
        <h5 class=\"card-title\">Card Title</h5>
        <p class=\"card-text\">Some quick example text.</p>
        <a href=\"#\" class=\"btn btn-primary\">Go somewhere</a>
    </div>
</div>
```

### 2. Navigation
Build responsive navigation bars:

```html
<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">
    <div class=\"container-fluid\">
        <a class=\"navbar-brand\" href=\"#\">Navbar</a>
        <button class=\"navbar-toggler\" type=\"button\">
            <span class=\"navbar-toggler-icon\"></span>
        </button>
    </div>
</nav>
```

### 3. Forms
Create accessible, styled forms:

```html
<div class=\"mb-3\">
    <label for=\"email\" class=\"form-label\">Email</label>
    <input type=\"email\" class=\"form-control\" id=\"email\">
</div>
```

## Utility Classes

Bootstrap 5's utility classes make styling effortless:

- **Spacing**: `m-3`, `p-4`, `mx-auto`
- **Colors**: `text-primary`, `bg-success`
- **Flexbox**: `d-flex`, `justify-content-center`
- **Typography**: `fs-1`, `fw-bold`

## Responsive Design

Bootstrap's grid system adapts to any screen size:

```html
<div class=\"row\">
    <div class=\"col-md-8\">Main content</div>
    <div class=\"col-md-4\">Sidebar</div>
</div>
```

## Conclusion

Bootstrap 5 empowers developers to create stunning, responsive web applications quickly and efficiently. Its comprehensive component library and utility classes make it the perfect choice for modern web development.

Start building amazing interfaces with Bootstrap 5 today!",
            'author_id' => $regularUser->id,
            'category_id' => $techCategory->id,
            'status' => 'published',
            'views' => 890,
            'published_at' => now()->subDays(5),
        ]);
        
        $post3 = Post::create([
            'title' => 'The Future of Remote Work: Trends and Technologies',
            'slug' => 'future-remote-work-trends-technologies',
            'excerpt' => 'Explore how remote work is evolving and the technologies that are shaping the future of distributed teams.',
            'content' => "# The Future of Remote Work: Trends and Technologies

The landscape of work has fundamentally changed. Remote work, once considered a perk, has become a necessity and preference for millions of professionals worldwide.

## The Remote Work Revolution

The shift to remote work has accelerated digital transformation across industries:

- **Increased Productivity**: 77% of remote workers report higher productivity
- **Better Work-Life Balance**: Flexible schedules improve employee satisfaction
- **Global Talent Access**: Companies can hire the best talent regardless of location
- **Reduced Costs**: Lower overhead and operational expenses

## Essential Technologies

### 1. Communication Platforms
Modern teams rely on sophisticated communication tools:

- **Video Conferencing**: Zoom, Microsoft Teams, Google Meet
- **Instant Messaging**: Slack, Discord, Microsoft Teams
- **Asynchronous Communication**: Loom, Notion, Confluence

### 2. Project Management
Keeping distributed teams aligned requires robust project management:

- **Task Management**: Trello, Asana, Monday.com
- **Agile Tools**: Jira, Azure DevOps, Linear
- **Time Tracking**: Toggl, RescueTime, Clockify

### 3. Cloud Infrastructure
Remote work depends on reliable cloud services:

- **File Storage**: Google Drive, Dropbox, OneDrive
- **Development**: GitHub, GitLab, AWS
- **Security**: VPNs, Multi-factor Authentication, Zero Trust

## Emerging Trends

### Virtual Reality Workspaces
VR technology is creating immersive work environments:

- **Virtual Offices**: Horizon Workrooms, Spatial
- **3D Collaboration**: Immersive design reviews and meetings
- **Training Simulations**: Safe, scalable employee training

### AI-Powered Assistance
Artificial intelligence is enhancing remote work productivity:

- **Smart Scheduling**: AI-optimized meeting times
- **Automated Transcription**: Real-time meeting notes
- **Intelligent Insights**: Performance and productivity analytics

### Hybrid Work Models
The future combines the best of both worlds:

- **Flexible Schedules**: Choose when and where to work
- **Hot Desking**: Shared office spaces when needed
- **Digital-First Culture**: Remote-friendly processes

## Challenges and Solutions

### 1. Communication Gaps
**Challenge**: Miscommunication and isolation
**Solution**: Regular check-ins, clear documentation, video-first meetings

### 2. Cybersecurity Risks
**Challenge**: Increased security vulnerabilities
**Solution**: Zero-trust architecture, VPN access, security training

### 3. Work-Life Balance
**Challenge**: Blurred boundaries between work and personal life
**Solution**: Set clear boundaries, dedicated workspace, regular breaks

## Building Remote Culture

Successful remote organizations focus on:

- **Trust and Autonomy**: Outcome-based performance metrics
- **Inclusive Meetings**: Ensure all voices are heard
- **Virtual Team Building**: Online events and activities
- **Continuous Learning**: Skill development opportunities

## The Road Ahead

Remote work will continue evolving with:

- **Advanced Collaboration Tools**: More immersive and intuitive platforms
- **Improved Security**: Better protection for distributed workforces
- **Wellness Technology**: Tools supporting mental and physical health
- **Sustainable Practices**: Reduced commuting and office space

## Conclusion

The future of work is flexible, technology-driven, and globally connected. Organizations that embrace remote work technologies and culture will attract top talent and achieve sustainable growth.

The remote work revolution is just beginning, and the possibilities are limitless!",
            'author_id' => $adminUser->id,
            'category_id' => $businessCategory->id,
            'status' => 'published',
            'views' => 654,
            'published_at' => now()->subDays(7),
        ]);
        
        // Attach tags to posts
        $post1->tags()->attach([$webTag->id, $laravelTag->id]);
        $post2->tags()->attach([$webTag->id]);
        $post3->tags()->attach([$startupTag->id]);
    }
}