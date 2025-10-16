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
            <button class="nav-tab" data-tab="categories">Chủ đề</button>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="news-content">
    <div class="container">
        <div class="row">
            <!-- Main Content Area -->
            <div class="col-lg-8">
                <!-- Hot News Section -->
                <div class="news-section active" id="hot-section">
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
                                                <span><i class="fa fa-eye"></i> {{ $firstNews->views }} lượt xem</span>
                                                <span><i class="fa fa-user"></i> {{ $firstNews->author->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($hotNews->count() > 1)
                                <div class="col-12">
                                    <div class="hot-news-list">
                                        @foreach($hotNews->skip(1) as $index => $news)
                                        <div class="hot-news-item">
                                            <div class="news-number">{{ $index + 2 }}</div>
                                            <div class="news-content">
                                                <h4><a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a></h4>
                                                <div class="news-meta">
                                                    <span class="time">{{ $news->formatted_date }}</span>
                                                    <span class="views">{{ $news->views }} lượt xem</span>
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
                                    <i class="fa fa-fire"></i>
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
                                <i class="fa fa-newspaper"></i>
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
                                <i class="fa fa-star"></i>
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
                        <i class="fa fa-folder"></i>
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
                                    <span class="time">{{ $article->formatted_date }}</span>
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
                                <a href="#" style="color: {{ $category->color }}">
                                    {{ $category->name }}
                                    <span class="count">({{ $category->news->count() }})</span>
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

/* Sidebar */
.news-sidebar {
    position: sticky;
    top: 20px;
}

.sidebar-widget {
    background: white;
    border-radius: 10px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.widget-title {
    background: #ff6b35;
    color: white;
    padding: 15px 20px;
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.widget-content {
    padding: 20px;
}

.sidebar-news-item {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.sidebar-news-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.sidebar-news-item .news-image {
    flex: 0 0 60px;
    overflow: hidden;
    border-radius: 5px;
}

.sidebar-news-item .news-image img {
    width: 100%;
    height: 50px;
    object-fit: cover;
}

.sidebar-news-item .news-content {
    flex: 1;
}

.sidebar-news-item h6 {
    margin-bottom: 5px;
}

.sidebar-news-item h6 a {
    color: #333;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.sidebar-news-item h6 a:hover {
    color: #ff6b35;
}

.sidebar-news-item .time {
    color: #666;
    font-size: 0.8rem;
}

.category-item {
    margin-bottom: 10px;
}

.category-item a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 0;
    text-decoration: none;
    color: #333;
    transition: color 0.3s ease;
}

.category-item a:hover {
    color: #ff6b35;
}

.category-item .count {
    color: #999;
    font-size: 0.8rem;
}

.popular-news-item {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.popular-news-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.popular-news-item .rank {
    flex: 0 0 25px;
    height: 25px;
    background: #ff6b35;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.8rem;
}

.popular-news-item .news-content {
    flex: 1;
}

.popular-news-item h6 {
    margin-bottom: 5px;
}

.popular-news-item h6 a {
    color: #333;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.popular-news-item h6 a:hover {
    color: #ff6b35;
}

.popular-news-item .views {
    color: #666;
    font-size: 0.8rem;
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
    
    navTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all tabs and sections
            navTabs.forEach(t => t.classList.remove('active'));
            newsSections.forEach(s => s.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding section
            this.classList.add('active');
            document.getElementById(targetTab + '-section').classList.add('active');
        });
    });
});
</script>
@endsection