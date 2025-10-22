@extends('layouts.main')

@section('title', 'Tin tức Billiard - VietNamPool')

@section('content')
<!-- Navigation Tabs -->
<div class="news-nav">
    <div class="container">
        <div class="nav-tabs">
            <button class="nav-tab active" data-tab="hot">Nóng</button>
            <button class="nav-tab" data-tab="latest">Mới</button>
            <button class="nav-tab" data-tab="featured">Nổi bật</button>
            <div class="nav-dropdown">
                <button class="nav-tab dropdown-toggle" data-tab="categories">
                    Chủ đề
                </button>
                <div class="dropdown-menu level-1">
                    <!-- All Categories Option -->
                    <a href="#" class="dropdown-item all-categories" data-category="all">
                        <div class="category-icon">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="category-info">
                            <span class="category-name">Tất cả chủ đề</span>
                            <span class="category-desc">Tất cả tin tức</span>
                        </div>
                        <div class="category-count">
                            <span>{{ $categories->sum(function($cat) { return $cat->news->count(); }) }}</span>
                        </div>
                    </a>
                    
                    <!-- Parent Categories with Children -->
                    @foreach($categories as $category)
                    <!-- Parent Category -->
                    <div class="dropdown-item parent-category" data-category="{{ $category->id }}" style="border-color: {{ $category->color }}">
                        <div class="category-icon" style="background-color: {{ $category->color }}">
                            <i class="fas fa-folder"></i>
                        </div>
                        <div class="category-info">
                            <span class="category-name">{{ $category->name }}</span>
                            <span class="category-desc">{{ $category->children->count() }} chủ đề con</span>
                        </div>
                        <div class="category-count">
                            <span>{{ $category->news->count() }}</span>
                        </div>
                        <div class="category-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    
                    <!-- Child Categories (Indented) -->
                    @if($category->children->count() > 0)
                        @foreach($category->children as $child)
                        <a href="#" class="dropdown-item child-category" data-category="{{ $child->id }}" style="color: {{ $child->color }}">
                            <div class="category-icon child-icon" style="background-color: {{ $child->color }}">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="category-info">
                                <span class="category-name">{{ $child->name }}</span>
                                <span class="category-desc">Chủ đề con</span>
                            </div>
                            <div class="category-count">
                                <span>{{ $child->news->count() }}</span>
                            </div>
                        </a>
                        @endforeach
                    @endif
                    @endforeach
                </div>
            </div>
            <div style="margin-left:auto;display:flex;align-items:center;gap:8px;">
                <form action="{{ route('news.index') }}" method="GET" style="display:flex;gap:8px;align-items:center;">
                    <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Tìm kiếm tin tức..." style="padding:8px 12px;border:1px solid #e5e7eb;border-radius:8px;min-width:240px;">
                    <button type="submit" class="nav-tab" style="border:1px solid #e5e7eb;border-radius:8px;">Tìm</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="news-content">
    <div class="container">
        <div class="row">
            <!-- Main Content Area -->
            <div class="col-lg-8">
                @if(!empty($search))
                <div class="news-section active" id="search-section">
                    <div class="section-header">
                        <h2>Kết quả tìm kiếm</h2>
                        <span class="section-subtitle">Từ khóa: "{{ $search }}"</span>
                    </div>
                    <div class="row">
                        @if($searchResults && $searchResults->count())
                            @foreach($searchResults as $article)
                            <div class="col-md-6 mb-4">
                                <div class="news-card">
                                    <div class="news-image">
                                        @if($article->image)
                                            <img src="{{ Storage::url('news/' . $article->image) }}" alt="{{ $article->title }}">
                                        @else
                                            <img src="{{ asset('images/bi-a.jpg') }}" alt="{{ $article->title }}">
                                        @endif
                                        @if($article->category)
                                            <div class="category-badge" style="background-color: {{ $article->category->color }}">
                                                {{ $article->category->name }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="news-content">
                                        <h4 class="news-title">
                                            <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                                        </h4>
                                        <p class="news-excerpt">{{ Str::limit($article->excerpt, 100) }}</p>
                                        <div class="news-meta">
                                            <span class="author">{{ $article->author->name }}</span>
                                            <span class="time">{{ $article->formatted_date }}</span>
                                            <span class="views">{{ $article->views }} lượt xem</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-12">
                                {{ $searchResults->links() }}
                            </div>
                        @else
                            <div class="col-12">
                                <div class="no-news">
                                    <i class="fas fa-search"></i>
                                    <p>Không tìm thấy kết quả phù hợp.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Hot News Section -->
                <div class="news-section {{ empty($search) ? 'active' : '' }}" id="hot-section">
                    <div class="section-header">
                        <h2>Tin nóng</h2>
                        <span class="section-subtitle">Những tin tức được quan tâm nhất</span>
                    </div>
                    <div class="row">
                        @if($hotNews->count() > 0)
                            <div class="col-12">
                                <div class="hot-news-main">
                                    @php $firstNews = $hotNews->first(); @endphp
                                    <div class="hot-news-card featured">
                                        <div class="news-image">
                                            @if($firstNews->image)
                                                <img src="{{ Storage::url('news/' . $firstNews->image) }}" alt="{{ $firstNews->title }}">
                                            @else
                                                <img src="{{ asset('images/bi-a.jpg') }}" alt="{{ $firstNews->title }}">
                                            @endif
                                            <div class="news-badge hot">HOT</div>
                                        </div>
                                        <div class="news-content">
                                            <div class="news-meta">
                                                @if($firstNews->category)
                                                    <span class="category-tag" style="background-color: {{ $firstNews->category->color }}">
                                                        {{ $firstNews->category->name }}
                                                    </span>
                                                @endif
                                                <span class="time">{{ $firstNews->formatted_date }}</span>
                                            </div>
                                            <h3 class="news-title">
                                                <a href="{{ route('news.show', $firstNews->slug) }}">{{ $firstNews->title }}</a>
                                            </h3>
                                            <p class="news-excerpt">{{ $firstNews->excerpt }}</p>
                                            <div class="news-stats">
                                                <span><i class="fas fa-eye"></i> {{ $firstNews->views }} lượt xem</span>
                                                <span><i class="fas fa-user"></i> {{ $firstNews->author->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($hotNews->count() > 1)
                                <div class="col-12">
                                    <div class="hot-news-list">
                                        @foreach($hotNews->skip(1) as $index => $news)
                                        <div class="hot-news-card">
                                            <div class="news-image">
                                                @if($news->image)
                                                    <img src="{{ Storage::url('news/' . $news->image) }}" alt="{{ $news->title }}">
                                                @else
                                                    <img src="{{ asset('images/bi-a.jpg') }}" alt="{{ $news->title }}">
                                                @endif
                                                <div class="news-badge hot">{{ $index + 2 }}</div>
                                            </div>
                                            <div class="news-content">
                                                <div class="news-meta">
                                                    @if($news->category)
                                                        <span class="category-tag" style="background-color: {{ $news->category->color }}">
                                                            {{ $news->category->name }}
                                                        </span>
                                                    @endif
                                                    <span class="time">{{ $news->formatted_date }}</span>
                                                </div>
                                                <h3 class="news-title">
                                                    <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                                                </h3>
                                                <p class="news-excerpt">{{ $news->excerpt }}</p>
                                                <div class="news-stats">
                                                    <span><i class="fas fa-eye"></i> {{ $news->views }} lượt xem</span>
                                                    <span><i class="fas fa-user"></i> {{ $news->author->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-12">
                                <div class="no-news">
                                    <i class="fas fa-fire"></i>
                                    <p>Chưa có tin nóng nào</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Latest News Section -->
                <div class="news-section" id="latest-section">
                    <div class="section-header">
                        <h2>Tin mới nhất</h2>
                        <span class="section-subtitle">Cập nhật liên tục</span>
                    </div>
                    <div class="row">
                        @forelse($latestNews as $article)
                        <div class="col-md-6 mb-4">
                            <div class="news-card">
                                <div class="news-image">
                                    @if($article->image)
                                        <img src="{{ Storage::url('news/' . $article->image) }}" alt="{{ $article->title }}">
                                    @else
                                        <img src="{{ asset('images/bi-a.jpg') }}" alt="{{ $article->title }}">
                                    @endif
                                    @if($article->category)
                                        <div class="category-badge" style="background-color: {{ $article->category->color }}">
                                            {{ $article->category->name }}
                                        </div>
                                    @endif
                                </div>
                                <div class="news-content">
                                    <h4 class="news-title">
                                        <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                                    </h4>
                                    <p class="news-excerpt">{{ Str::limit($article->excerpt, 100) }}</p>
                                    <div class="news-meta">
                                        <span class="author">{{ $article->author->name }}</span>
                                        <span class="time">{{ $article->formatted_date }}</span>
                                        <span class="views">{{ $article->views }} lượt xem</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="no-news">
                                <i class="fas fa-newspaper"></i>
                                <p>Chưa có tin tức nào</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Featured News Section -->
                <div class="news-section" id="featured-section">
                    <div class="section-header">
                        <h2>Tin nổi bật</h2>
                        <span class="section-subtitle">Những bài viết đặc biệt</span>
                    </div>
                    <div class="row">
                        @forelse($featuredNews as $article)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="featured-card">
                                <div class="news-image">
                                    @if($article->image)
                                        <img src="{{ Storage::url('news/' . $article->image) }}" alt="{{ $article->title }}">
                                    @else
                                        <img src="{{ asset('images/bi-a.jpg') }}" alt="{{ $article->title }}">
                                    @endif
                                    <div class="featured-badge">Nổi bật</div>
                                </div>
                                <div class="news-content">
                                    <h5 class="news-title">
                                        <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                                    </h5>
                                    <div class="news-meta">
                                        <span class="time">{{ $article->formatted_date }}</span>
                                        <span class="views">{{ $article->views }} lượt xem</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="no-news">
                                <i class="fas fa-star"></i>
                                <p>Chưa có tin nổi bật nào</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="news-section" id="categories-section">
                    <div class="section-header">
                        <h2>Theo chủ đề</h2>
                        <span class="section-subtitle">Tin tức phân loại theo danh mục</span>
                    </div>
                    @forelse($categories as $category)
                    <div class="category-section">
                        <div class="category-header">
                            <h3 style="color: {{ $category->color }}">
                                {{ $category->name }}
                            </h3>
                            <span class="category-count">{{ $category->news->count() }} bài viết</span>
                        </div>
                        <div class="row">
                            @forelse($category->news as $article)
                            <div class="col-md-4 mb-3">
                                <div class="category-news-item">
                                    <div class="news-image">
                                        @if($article->image)
                                            <img src="{{ Storage::url('news/' . $article->image) }}" alt="{{ $article->title }}">
                                        @else
                                            <img src="{{ asset('images/bi-a.jpg') }}" alt="{{ $article->title }}">
                                        @endif
                                    </div>
                                    <div class="news-content">
                                        <h6 class="news-title">
                                            <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                                        </h6>
                                        <div class="news-meta">
                                            <span class="time">{{ $article->formatted_date }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <p class="text-muted">Chưa có bài viết nào trong danh mục này</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    @empty
                    <div class="no-news">
                        <i class="fas fa-folder"></i>
                        <p>Chưa có danh mục nào</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="news-sidebar">
                    <!-- Latest News Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Tin mới</h3>
                        <div class="widget-content">
                            @foreach($latestNews->take(5) as $article)
                            <div class="sidebar-news-item">
                                <div class="news-image">
                                    @if($article->image)
                                        <img src="{{ Storage::url('news/' . $article->image) }}" alt="{{ $article->title }}">
                                    @else
                                        <img src="{{ asset('images/bi-a.jpg') }}" alt="{{ $article->title }}">
                                    @endif
                                </div>
                                <div class="news-content">
                                    <h6><a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a></h6>
                                    <span class="time">F{{ $article->formatted_date }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Danh mục</h3>
                        <div class="widget-content">
                            @foreach($categories as $category)
                            <div class="category-item">
                                <a href="#" class="sidebar-category-link" data-category="{{ $category->id }}" style="color: {{ $category->color }}">
                                    <div class="category-icon-small" style="background-color: {{ $category->color }}">
                                        <i class="fas fa-folder"></i>
                                    </div>
                                    <div class="category-info">
                                        <span class="category-name">{{ $category->name }}</span>
                                        <span class="category-desc">{{ $category->children->count() }} chủ đề con</span>
                                    </div>
                                    <div class="category-count">
                                        <span>{{ $category->news->count() }}</span>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Popular News Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Xem nhiều</h3>
                        <div class="widget-content">
                            @foreach($hotNews->take(5) as $index => $article)
                            <div class="popular-news-item">
                                <div class="rank">{{ $index + 1 }}</div>
                                <div class="news-content">
                                    <h6><a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a></h6>
                                    <span class="views">{{ $article->views }} lượt xem</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Header Styles */
.news-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 0;
    color: white;
    text-align: center;
}

.news-header h1 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.news-header p {
    font-size: 1.1rem;
    opacity: 0.9;
}

/* Navigation Tabs */
.news-nav {
    background: white;
    border-bottom: 1px solid #eee;
    padding: 0;
}

.nav-tabs {
    display: flex;
    gap: 0;
}

.nav-tab {
    background: none;
    border: none;
    padding: 15px 25px;
    font-size: 1rem;
    font-weight: 500;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
    border-bottom: 3px solid transparent;
}

.nav-tab:hover,
.nav-tab.active {
    color: #ff6b35;
    border-bottom-color: #ff6b35;
    background: #fff5f2;
}

/* Dropdown Navigation */
.nav-dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
}

.dropdown-toggle i {
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}

.nav-dropdown:hover .dropdown-toggle i {
    transform: rotate(180deg);
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.15);
    border: 1px solid #e5e7eb;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    min-width: 320px;
    max-height: 400px;
    overflow-y: auto;
    overflow-x: hidden;
    display: block;
}

/* Custom scrollbar for dropdown */
.dropdown-menu::-webkit-scrollbar {
    width: 6px;
}

.dropdown-menu::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.dropdown-menu::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.dropdown-menu::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Two-level navigation */
.dropdown-menu.level-1 {
    display: block;
}

/* Parent Category Styling */
.parent-category {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-left: 4px solid;
    font-weight: 600;
    position: relative;
}

.parent-category:hover {
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
    transform: translateX(5px);
}

.parent-category .category-name {
    font-size: 15px;
    font-weight: 700;
    color: #2d3748;
}

.parent-category .category-desc {
    font-size: 12px;
    color: #4a5568;
    font-weight: 500;
}

.parent-category .category-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.parent-category .category-arrow {
    color: #4a5568;
    font-size: 12px;
}

/* Child Category Styling */
.child-category {
    background: #ffffff;
    border-left: 2px solid #e2e8f0;
    margin-left: 20px;
    padding-left: 20px;
    position: relative;
    font-weight: 500;
    transition: all 0.3s ease;
}

.child-category:hover {
    background: #f8fafc;
    border-left-color: #667eea;
    transform: translateX(8px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.child-category .category-name {
    font-size: 13px;
    font-weight: 600;
    color: #4a5568;
}

.child-category .category-desc {
    font-size: 11px;
    color: #9ca3af;
    font-weight: 400;
}

.child-category .category-icon {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
}

.child-category .category-count {
    font-size: 11px;
    color: #9ca3af;
}

/* Child Category Indentation */
.child-category::before {
    content: '';
    position: absolute;
    left: -10px;
    top: 50%;
    transform: translateY(-50%);
    width: 6px;
    height: 6px;
    background: #cbd5e1;
    border-radius: 50%;
}

.child-category:hover::before {
    background: #667eea;
}

/* Visual Hierarchy */
.parent-category + .child-category {
    margin-top: 2px;
}

.child-category + .child-category {
    margin-top: 1px;
}

.parent-category + .parent-category {
    margin-top: 8px;
    border-top: 1px solid #e2e8f0;
    padding-top: 8px;
}

/* Submenu Header */
.submenu-header {
    padding: 16px 20px 12px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
    border-radius: 12px 12px 0 0;
}

.submenu-title {
    font-weight: 600;
    color: #2d3748;
    font-size: 14px;
}

/* Submenu Content */
.submenu-content {
    padding: 8px 0;
}

.submenu-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    text-decoration: none;
    color: #4a5568;
    font-weight: 500;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.submenu-item:hover {
    background: #f8fafc;
    color: #667eea;
    border-left-color: #667eea;
    transform: translateX(5px);
}

.submenu-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.submenu-name {
    flex: 1;
    font-size: 13px;
}

.submenu-count {
    font-size: 11px;
    color: #9ca3af;
    font-weight: 400;
}

.submenu-empty {
    padding: 20px;
    text-align: center;
    color: #9ca3af;
    font-size: 12px;
    font-style: italic;
}

/* Custom scrollbar for level 2 dropdown */
.dropdown-menu.level-2::-webkit-scrollbar {
    width: 6px;
}

.dropdown-menu.level-2::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.dropdown-menu.level-2::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.dropdown-menu.level-2::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Firefox scrollbar */
.dropdown-menu {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

.dropdown-menu.level-2 {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
}

/* Ensure dropdown items don't overflow */
.dropdown-item {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Mobile responsive scrollbar */
@media (max-width: 768px) {
    .dropdown-menu {
        max-height: 300px;
        min-width: 280px;
    }
    
    .parent-category {
        padding: 12px 16px;
    }
    
    .child-category {
        margin-left: 16px;
        padding-left: 16px;
    }
    
    .parent-category .category-icon {
        width: 36px;
        height: 36px;
    }
    
    .child-category .category-icon {
        width: 28px;
        height: 28px;
    }
    
    .parent-category .category-name {
        font-size: 14px;
    }
    
    .child-category .category-name {
        font-size: 12px;
    }
    
    .parent-category .category-desc {
        font-size: 11px;
    }
    
    .child-category .category-desc {
        font-size: 10px;
    }
}

.nav-dropdown:hover .dropdown-menu,
.nav-dropdown.show .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    text-decoration: none;
    color: #4a5568;
    font-weight: 500;
    transition: all 0.3s ease;
    border-bottom: 1px solid #f1f5f9;
    position: relative;
    min-height: 60px;
}

.dropdown-item:last-child {
    border-bottom: none;
}

.dropdown-item:hover {
    background: #f8fafc;
    color: #667eea;
    transform: translateX(5px);
}

/* All Categories Special Styling */
.all-categories {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    margin-bottom: 8px;
    border-radius: 8px;
}

.all-categories:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    transform: translateX(0);
}

.all-categories .category-icon {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.all-categories .category-count span {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

/* Parent Category Styling */
.parent-category {
    border-left: 4px solid transparent;
    transition: all 0.3s ease;
}

.parent-category:hover {
    border-left-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
}

/* Category Icon */
.category-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: white;
    flex-shrink: 0;
}

/* Category Info */
.category-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.category-name {
    font-size: 14px;
    font-weight: 600;
    color: #2d3748;
    line-height: 1.3;
}

.category-desc {
    font-size: 12px;
    color: #718096;
    line-height: 1.2;
}

/* Category Count */
.category-count {
    flex-shrink: 0;
}

.category-count span {
    background: #f1f5f9;
    color: #4a5568;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    min-width: 24px;
    text-align: center;
    display: inline-block;
}

/* Category Arrow */
.category-arrow {
    flex-shrink: 0;
    color: #9ca3af;
    font-size: 12px;
    transition: all 0.3s ease;
}

.parent-category:hover .category-arrow {
    color: #667eea;
    transform: translateX(3px);
}

/* Dropdown Header */
.dropdown-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
    border-radius: 12px 12px 0 0;
}

.back-button {
    background: none;
    border: none;
    color: #667eea;
    font-size: 16px;
    cursor: pointer;
    padding: 8px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.back-button:hover {
    background: rgba(102, 126, 234, 0.1);
    transform: translateX(-2px);
}

.parent-name {
    font-weight: 600;
    color: #2d3748;
    font-size: 14px;
}

/* Child Category Styling */
.child-category {
    border-left: 4px solid transparent;
}

.child-category:hover {
    border-left-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
}

.child-category .category-icon {
    background: #e5e7eb;
    color: #6b7280;
}

.child-category:hover .category-icon {
    background: #667eea;
    color: white;
}

.category-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.category-count {
    margin-left: auto;
    color: #9ca3af;
    font-size: 0.8rem;
    font-weight: 400;
}

/* Loading Spinner */
.loading-spinner {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    text-align: center;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #667eea;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 15px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-spinner p {
    color: #6b7280;
    font-size: 0.9rem;
    margin: 0;
}

/* Alert Messages */
.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-info {
    background-color: #dbeafe;
    border-color: #93c5fd;
    color: #1e40af;
}

.alert-success {
    background-color: #d1fae5;
    border-color: #86efac;
    color: #065f46;
}

.alert-danger {
    background-color: #fee2e2;
    border-color: #fca5a5;
    color: #991b1b;
}

.alert i {
    font-size: 1.1rem;
}

/* Main Content */
.news-content {
    padding: 40px 0;
    background: #f8f9fa;
}

.news-section {
    display: none;
}

.news-section.active {
    display: block;
}

/* Ensure only one section is visible at a time */
.news-section:not(.active) {
    display: none !important;
}

.section-header {
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #eee;
}

.section-header h2 {
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

.section-subtitle {
    color: #666;
    font-size: 0.9rem;
}

/* Hot News Styles */
.hot-news-main {
    margin-bottom: 30px;
}

.hot-news-card.featured {
    display: flex;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.hot-news-card .news-image {
    flex: 0 0 300px;
    position: relative;
    overflow: hidden;
}

.hot-news-card .news-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

/* Small hot news cards - similar to main card but smaller */
.hot-news-list .hot-news-card {
    display: flex;
    margin-bottom: 15px;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hot-news-list .hot-news-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.hot-news-list .hot-news-card .news-image {
    flex: 0 0 200px;
    position: relative;
    overflow: hidden;
}

.hot-news-list .hot-news-card .news-image img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}

.hot-news-list .hot-news-card .news-content {
    flex: 1;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.hot-news-list .hot-news-card .news-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}

.hot-news-list .hot-news-card .category-tag {
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    color: white;
    font-weight: 500;
}

.hot-news-list .hot-news-card .time {
    color: #6b7280;
    font-size: 0.8rem;
}

.hot-news-list .hot-news-card .news-title {
    margin: 0 0 8px 0;
    font-size: 1rem;
    line-height: 1.4;
}

.hot-news-list .hot-news-card .news-title a {
    color: #1f2937;
    text-decoration: none;
    transition: color 0.3s ease;
}

.hot-news-list .hot-news-card .news-title a:hover {
    color: #ef4444;
}

.hot-news-list .hot-news-card .news-excerpt {
    color: #6b7280;
    font-size: 0.85rem;
    line-height: 1.4;
    margin: 0 0 10px 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.hot-news-list .hot-news-card .news-stats {
    display: flex;
    gap: 15px;
    font-size: 0.8rem;
    color: #6b7280;
}

.hot-news-list .hot-news-card .news-stats span {
    display: flex;
    align-items: center;
    gap: 4px;
}

.hot-news-list .hot-news-card .news-stats i {
    font-size: 0.75rem;
}

.news-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: bold;
    color: white;
}

.news-badge.hot {
    background: #ff4757;
}

.hot-news-card .news-content {
    flex: 1;
    padding: 20px;
}

.news-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.category-tag {
    padding: 4px 8px;
    border-radius: 4px;
    color: white;
    font-size: 0.8rem;
    font-weight: 500;
}

.time {
    color: #666;
    font-size: 0.9rem;
}

.news-title {
    margin-bottom: 15px;
}

.news-title a {
    color: #333;
    text-decoration: none;
    font-size: 1.3rem;
    font-weight: bold;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.news-title a:hover {
    color: #ff6b35;
}

.news-excerpt {
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
}

.news-stats {
    display: flex;
    gap: 20px;
    color: #999;
    font-size: 0.9rem;
}

.news-stats span {
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Hot News List */
.hot-news-list {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.hot-news-item {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #f0f0f0;
    transition: background 0.3s ease;
}

.hot-news-item:hover {
    background: #f8f9fa;
}

.hot-news-item:last-child {
    border-bottom: none;
}

.news-number {
    flex: 0 0 30px;
    height: 30px;
    background: #ff6b35;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 15px;
}

.hot-news-item .news-content {
    flex: 1;
}

.hot-news-item h4 {
    margin-bottom: 5px;
}

.hot-news-item h4 a {
    color: #333;
    text-decoration: none;
    font-size: 1rem;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.hot-news-item h4 a:hover {
    color: #ff6b35;
}

.hot-news-item .news-meta {
    display: flex;
    gap: 15px;
    font-size: 0.8rem;
    color: #666;
}

/* News Cards */
.news-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.news-card .news-image {
    position: relative;
    overflow: hidden;
}

.news-card .news-image img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.news-card:hover .news-image img {
    transform: scale(1.05);
}

.category-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 4px 8px;
    border-radius: 4px;
    color: white;
    font-size: 0.8rem;
    font-weight: 500;
}

.news-card .news-content {
    padding: 15px;
}

.news-card .news-title {
    margin-bottom: 10px;
}

.news-card .news-title a {
    color: #333;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.news-card .news-title a:hover {
    color: #ff6b35;
}

.news-card .news-excerpt {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 10px;
}

.news-card .news-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.8rem;
    color: #999;
}

/* Featured Cards */
.featured-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.featured-card:hover {
    transform: translateY(-3px);
}

.featured-card .news-image {
    position: relative;
    overflow: hidden;
}

.featured-card .news-image img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}

.featured-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ff6b35;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 500;
}

.featured-card .news-content {
    padding: 15px;
}

.featured-card .news-title a {
    color: #333;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.featured-card .news-title a:hover {
    color: #ff6b35;
}

/* Category Sections */
.category-section {
    background: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.category-header h3 {
    font-size: 1.3rem;
    font-weight: bold;
    margin: 0;
}

.category-count {
    color: #666;
    font-size: 0.9rem;
}

.category-news-item {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.category-news-item .news-image {
    flex: 0 0 80px;
    overflow: hidden;
    border-radius: 5px;
}

.category-news-item .news-image img {
    width: 100%;
    height: 60px;
    object-fit: cover;
}

.category-news-item .news-content {
    flex: 1;
}

.category-news-item .news-title a {
    color: #333;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.category-news-item .news-title a:hover {
    color: #ff6b35;
}

/* Modern Sidebar Design */
.news-sidebar {
    position: sticky;
    top: 20px;
}

.sidebar-widget {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 16px;
    margin-bottom: 25px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid rgba(255,255,255,0.2);
    overflow: hidden;
    transition: all 0.3s ease;
}

.sidebar-widget:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.widget-title {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 18px 20px;
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;
}

.widget-title::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.widget-title:hover::before {
    left: 100%;
}

.widget-content {
    padding: 20px;
}

.sidebar-news-item {
    display: flex;
    gap: 12px;
    margin-bottom: 16px;
    padding: 12px;
    border-radius: 12px;
    background: rgba(255,255,255,0.5);
    border: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.sidebar-news-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 3px;
    height: 100%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.sidebar-news-item:hover {
    background: rgba(102, 126, 234, 0.05);
    border-color: rgba(102, 126, 234, 0.2);
    transform: translateX(5px);
}

.sidebar-news-item:hover::before {
    transform: scaleY(1);
}

.sidebar-news-item:last-child {
    margin-bottom: 0;
}

.sidebar-news-item .news-image {
    flex: 0 0 70px;
    overflow: hidden;
    border-radius: 10px;
    position: relative;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.sidebar-news-item .news-image img {
    width: 100%;
    height: 60px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.sidebar-news-item:hover .news-image img {
    transform: scale(1.05);
}

.sidebar-news-item .news-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.sidebar-news-item h6 {
    margin: 0 0 8px 0;
    line-height: 1.4;
}

.sidebar-news-item h6 a {
    color: #2d3748;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    line-height: 1.4;
    transition: all 0.3s ease;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.sidebar-news-item h6 a:hover {
    color: #667eea;
    text-shadow: 0 1px 2px rgba(102, 126, 234, 0.2);
}

.sidebar-news-item .time {
    color: #718096;
    font-size: 0.75rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 4px;
}

.sidebar-news-item .time::before {
    content: '🕒';
    font-size: 0.7rem;
}

/* Modern Category Items */
.category-item {
    margin-bottom: 8px;
}

.category-item a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    text-decoration: none;
    color: #4a5568;
    background: rgba(255,255,255,0.6);
    border-radius: 10px;
    border: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    font-weight: 500;
    position: relative;
    overflow: hidden;
}

.category-item a::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
    transition: left 0.5s;
}

.category-item a:hover {
    background: rgba(102, 126, 234, 0.08);
    border-color: rgba(102, 126, 234, 0.2);
    transform: translateX(5px);
    color: #667eea;
}

.category-item a:hover::before {
    left: 100%;
}

.category-item .count {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    min-width: 24px;
    text-align: center;
}

/* Sidebar Category Link Styling */
.sidebar-category-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    text-decoration: none;
    color: #4a5568;
    background: rgba(255,255,255,0.6);
    border-radius: 10px;
    border: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    font-weight: 500;
    position: relative;
    overflow: hidden;
    width: 100%;
}

.category-icon-small {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.category-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.category-name {
    font-weight: 600;
    font-size: 14px;
    color: #2d3748;
}

.category-desc {
    font-size: 11px;
    color: #9ca3af;
    font-weight: 400;
}

.category-count {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 6px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    min-width: 40px;
    text-align: center;
}

/* Modern Popular News Items */
.popular-news-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
    padding: 12px;
    background: rgba(255,255,255,0.5);
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    position: relative;
}

.popular-news-item:hover {
    background: rgba(102, 126, 234, 0.05);
    border-color: rgba(102, 126, 234, 0.2);
    transform: translateX(5px);
}

.popular-news-item:last-child {
    margin-bottom: 0;
}

.popular-news-item .rank {
    flex: 0 0 32px;
    height: 32px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    transition: all 0.3s ease;
}

.popular-news-item:hover .rank {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.popular-news-item .news-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.popular-news-item h6 {
    margin: 0;
    line-height: 1.4;
}

.popular-news-item h6 a {
    color: #2d3748;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    line-height: 1.4;
    transition: all 0.3s ease;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.popular-news-item h6 a:hover {
    color: #667eea;
    text-shadow: 0 1px 2px rgba(102, 126, 234, 0.2);
}

.popular-news-item .views {
    color: #718096;
    font-size: 0.75rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 4px;
}

.popular-news-item .views::before {
    content: '👁️';
    font-size: 0.7rem;
}

/* Full height for nav tabs and category dropdown */
.news-nav .nav-tabs {
    align-items: stretch;
}

.news-nav .nav-dropdown {
    display: flex;
    align-items: stretch;
}

.news-nav .dropdown-toggle {
    height: 100%;
    display: flex;
    align-items: center;
}

/* No News State */
.no-news {
    text-align: center;
    padding: 60px 20px;
    color: #999;
}

.no-news i {
    font-size: 3rem;
    margin-bottom: 20px;
    color: #ddd;
}

.no-news p {
    font-size: 1.1rem;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .news-header h1 {
        font-size: 2rem;
    }
    
    .nav-tabs {
        flex-wrap: wrap;
    }
    
    .nav-tab {
        flex: 1;
        min-width: 120px;
        text-align: center;
    }
    
    .hot-news-card.featured {
        flex-direction: column;
    }
    
    .hot-news-card .news-image {
        flex: none;
    }
    
    .news-sidebar {
        position: static;
        margin-top: 30px;
    }
    
    .sidebar-widget {
        margin-bottom: 20px;
    }
    
    .sidebar-news-item {
        padding: 10px;
        margin-bottom: 12px;
    }
    
    .sidebar-news-item .news-image {
        flex: 0 0 60px;
    }
    
    .sidebar-news-item .news-image img {
        height: 50px;
    }
    
    .category-item a {
        padding: 10px 12px;
    }
    
    .popular-news-item {
        padding: 10px;
        margin-bottom: 10px;
    }
    
    .popular-news-item .rank {
        flex: 0 0 28px;
        height: 28px;
        font-size: 0.8rem;
    }
    
    .category-news-item {
        flex-direction: column;
    }
    
    .category-news-item .news-image {
        flex: none;
        width: 100%;
    }
    
    .category-news-item .news-image img {
        height: 120px;
    }
}

@media (max-width: 576px) {
    .news-header {
        padding: 40px 0;
    }
    
    .news-header h1 {
        font-size: 1.8rem;
    }
    
    .section-header h2 {
        font-size: 1.5rem;
    }
    
    .hot-news-item {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .news-number {
        margin-bottom: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navTabs = document.querySelectorAll('.nav-tab');
    const newsSections = document.querySelectorAll('.news-section');
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    
    // Check if elements exist before proceeding
    if (!navTabs.length || !newsSections.length) {
        console.warn('Navigation elements not found');
        return;
    }
    
    // Handle regular tab clicks
    navTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            // Handle dropdown toggle clicks
            if (this.classList.contains('dropdown-toggle')) {
                e.stopPropagation();
                const dropdown = this.closest('.nav-dropdown');
                if (dropdown) {
                    dropdown.classList.toggle('show');
                }
                return;
            }
            
            const targetTab = this.getAttribute('data-tab');
            if (!targetTab) return;
            
            // Remove active class from all tabs and sections
            navTabs.forEach(t => {
                if (t) t.classList.remove('active');
            });
            newsSections.forEach(s => {
                if (s) s.classList.remove('active');
            });
            
            // Hide category section if it exists
            const categorySection = document.getElementById('category-section');
            if (categorySection) {
                categorySection.classList.remove('active');
            }
            
            // Add active class to clicked tab and corresponding section
            this.classList.add('active');
            const targetSection = document.getElementById(targetTab + '-section');
            if (targetSection) {
                targetSection.classList.add('active');
            }
        });
    });
    
    // Handle category dropdown clicks
    dropdownItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            const categoryId = this.getAttribute('data-category');
            const categoryName = this.querySelector('.category-name').textContent.trim();
            
            if (!categoryId || !categoryName) return;
            
            // Handle direct selection (all categories)
            selectCategory(categoryId, categoryName);
        });
    });
    
    // Handle child category clicks
    document.addEventListener('click', function(e) {
        if (e.target.closest('.child-category')) {
            e.preventDefault();
            const childItem = e.target.closest('.child-category');
            const categoryId = childItem.getAttribute('data-category');
            const categoryName = childItem.querySelector('.category-name').textContent.trim();
            
            if (categoryId && categoryName) {
                selectCategory(categoryId, categoryName);
            }
        }
    });
    
    // Handle sidebar category clicks
    document.addEventListener('click', function(e) {
        if (e.target.closest('.sidebar-category-link')) {
            e.preventDefault();
            const sidebarItem = e.target.closest('.sidebar-category-link');
            const categoryId = sidebarItem.getAttribute('data-category');
            const categoryName = sidebarItem.querySelector('.category-name').textContent.trim();
            
            if (categoryId && categoryName) {
                selectCategory(categoryId, categoryName);
            }
        }
    });
    
    // Function to handle parent category hover
    function handleParentHover(parentElement) {
        // Add hover effect to parent
        parentElement.classList.add('hovered');
    }
    
    // Function to handle parent category leave
    function handleParentLeave(parentElement) {
        // Remove hover effect from parent
        parentElement.classList.remove('hovered');
    }
    
    // Function to select a category
    function selectCategory(categoryId, categoryName) {
        // Close dropdown
        const dropdown = document.querySelector('.nav-dropdown');
        if (dropdown) {
            dropdown.classList.remove('show');
        }
        
        // Update dropdown button text
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        if (dropdownToggle) {
            dropdownToggle.innerHTML = categoryName + ' <i class="fas fa-chevron-down"></i>';
        }
        
        // Remove active class from all tabs
        navTabs.forEach(t => {
            if (t) t.classList.remove('active');
        });
        newsSections.forEach(s => {
            if (s) s.classList.remove('active');
        });
        
        // Hide any existing category section
        const existingCategorySection = document.getElementById('category-section');
        if (existingCategorySection) {
            existingCategorySection.classList.remove('active');
        }
        
        // Add active class to categories tab
        if (dropdownToggle) {
            dropdownToggle.classList.add('active');
        }
        
        // Show category content
        showCategoryContent(categoryId, categoryName);
    }
    
    // Add hover event listeners for parent categories
    document.addEventListener('DOMContentLoaded', function() {
        const parentCategories = document.querySelectorAll('.parent-category');
        parentCategories.forEach(parent => {
            parent.addEventListener('mouseenter', function() {
                // Show submenu on hover
                const submenu = this.querySelector('.submenu');
                if (submenu) {
                    submenu.style.display = 'block';
                    setTimeout(() => {
                        submenu.style.opacity = '1';
                        submenu.style.visibility = 'visible';
                        submenu.style.transform = 'translateX(0)';
                    }, 10);
                }
            });
            
            parent.addEventListener('mouseleave', function() {
                // Hide submenu when leaving
                const submenu = this.querySelector('.submenu');
                if (submenu) {
                    submenu.style.opacity = '0';
                    submenu.style.visibility = 'hidden';
                    submenu.style.transform = 'translateX(-10px)';
                    setTimeout(() => {
                        submenu.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
    
    // Function to show category content
    function showCategoryContent(categoryId, categoryName) {
        // Hide all existing sections first
        newsSections.forEach(s => {
            if (s) s.classList.remove('active');
        });
        
        // Create or update category section
        let categorySection = document.getElementById('category-section');
        if (!categorySection) {
            const mainContent = document.querySelector('.col-lg-8');
            if (!mainContent) {
                console.error('Main content area not found');
                return;
            }
            
            categorySection = document.createElement('div');
            categorySection.id = 'category-section';
            categorySection.className = 'news-section';
            mainContent.appendChild(categorySection);
        }
        
        // Update section header
        categorySection.innerHTML = `
            <div class="section-header">
                <h2>${categoryName}</h2>
                <span class="section-subtitle">Tin tức theo chủ đề</span>
            </div>
            <div class="category-news-container">
                <div class="loading-spinner">
                    <div class="spinner"></div>
                    <p>Đang tải tin tức...</p>
                </div>
            </div>
        `;
        
        // Show the section
        categorySection.classList.add('active');
        
        // Load news for this category
        loadCategoryNews(categoryId);
    }
    
    // Function to load news for specific category
    function loadCategoryNews(categoryId) {
        // Create loading state
        const container = document.querySelector('.category-news-container');
        if (!container) {
            console.error('Category news container not found');
            return;
        }
        
        // Make API call to get news by category
        fetch(`/api/news/category/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayCategoryNews(data.data, data.count);
                } else {
                    container.innerHTML = `
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    ${data.message || 'Lỗi khi tải tin tức'}
                                </div>
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading news:', error);
                container.innerHTML = `
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                                Lỗi kết nối. Vui lòng thử lại sau.
                            </div>
                        </div>
                    </div>
                `;
            });
    }
    
    // Function to display news articles
    function displayCategoryNews(news, count) {
        const container = document.querySelector('.category-news-container');
        if (!container) return;
        
        if (count === 0) {
            container.innerHTML = `
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Không có tin tức nào trong chủ đề này.
                        </div>
                    </div>
                </div>
            `;
            return;
        }
        
        let newsHtml = '<div class="row">';
        
        news.forEach((article, index) => {
            const imageUrl = article.image ? 
                `/storage/news/${article.image}` : 
                '/images/bi-a.jpg';
            
            const categoryColor = article.category ? article.category.color : '#667eea';
            const categoryName = article.category ? article.category.name : 'Khác';
            
            newsHtml += `
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="news-card">
                        <div class="news-image">
                            <img src="${imageUrl}" alt="${article.title}">
                            <div class="news-badge" style="background-color: ${categoryColor}">
                                ${categoryName}
                            </div>
                        </div>
                        <div class="news-content">
                            <div class="news-meta">
                                <span class="time">${formatDate(article.created_at)}</span>
                                <span class="views">${article.views} lượt xem</span>
                            </div>
                            <h3 class="news-title">
                                <a href="/news/${article.slug}">${article.title}</a>
                            </h3>
                            <p class="news-excerpt">${article.excerpt || 'Không có tóm tắt'}</p>
                            <div class="news-stats">
                                <span><i class="fas fa-user"></i> ${article.author.name}</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        
        newsHtml += '</div>';
        container.innerHTML = newsHtml;
    }
    
    // Helper function to format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('vi-VN', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.querySelector('.nav-dropdown');
        if (dropdown && !dropdown.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });
});
</script>
@endsection