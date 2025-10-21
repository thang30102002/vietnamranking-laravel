@extends('layouts.main')

@section('title', $news->title . ' - VietNamPool')

@section('content')
<style>
.content-image {
    text-align: center;
    margin: 20px 0;
    padding: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.content-image img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: block;
    object-fit: contain;
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
    image-rendering: pixelated;
    image-rendering: auto;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
}

.content-image img:hover {
    transform: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Đảm bảo ảnh không bị vỡ và giữ nguyên chất lượng */
@media (max-width: 768px) {
    .content-image img {
        max-width: 100%;
        height: auto;
        object-fit: contain;
    }
}

/* Đảm bảo ảnh không bị kéo giãn */
.content-image img[style*="width"] {
    width: auto !important;
    max-width: 100% !important;
}

.content-image img[style*="height"] {
    height: auto !important;
}

/* Đảm bảo tất cả ảnh trong nội dung không bị kéo giãn */
.article-body img {
    max-width: 100% !important;
    height: auto !important;
    object-fit: contain !important;
    image-rendering: auto !important;
}

/* Loại bỏ các thuộc tính width/height inline */
.article-body img[width] {
    width: auto !important;
}

.article-body img[height] {
    height: auto !important;
}
</style>
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="caption header-text">
                    <h6>Tin tức</h6>
                    <h2>{{ $news->title }}</h2>
                    <div class="post-meta">
                        <span><i class="fas fa-user"></i> {{ $news->author->name }}</span>
                        <span><i class="fas fa-calendar"></i> {{ $news->formatted_date }}</span>
                        <span><i class="fas fa-eye"></i> {{ $news->views }} lượt xem</span>
                        @if($news->category)
                        <span style="background-color: {{ $news->category->color }}; color: white; padding: 0.25rem 0.5rem; border-radius: 4px;">
                            @if($news->category->parent)
                                {{ $news->category->parent->name }} > 
                            @endif
                            {{ $news->category->name }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section trending">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="news-article">
                    @if($news->image)
                    <div class="article-image">
                        <img src="{{ Storage::url('news/' . $news->image) }}" alt="{{ $news->title }}" class="img-fluid">
                    </div>
                    @endif
                    
                    <div class="article-content">
                        @if($news->excerpt)
                        <div class="article-excerpt">
                            <p>{{ $news->excerpt }}</p>
                        </div>
                        @endif
                        
                        <div class="article-body">
                            {!! markdownToHtml($news->content) !!}
                        </div>
                    </div>
                    
                    <div class="article-footer">
                        <div class="share-buttons">
                            <h5>Chia sẻ bài viết:</h5>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-primary">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" target="_blank" class="btn btn-info">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-secondary">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="widget">
                        <h4>Tin tức liên quan</h4>
                        <div class="related-news">
                            @forelse($relatedNews as $related)
                            <div class="related-item">
                                <div class="related-image">
                                    @if($related->image)
                                        <img src="{{ Storage::url('news/' . $related->image) }}" alt="{{ $related->title }}">
                                    @else
                                        <img src="{{ asset('images/bi-a.jpg') }}" alt="{{ $related->title }}">
                                    @endif
                                </div>
                                <div class="related-content">
                                    <h5><a href="{{ route('news.show', $related->slug) }}">{{ $related->title }}</a></h5>
                                    <span class="related-date">{{ $related->formatted_date }}</span>
                                </div>
                            </div>
                            @empty
                            <p>Không có tin tức liên quan.</p>
                            @endforelse
                        </div>
                    </div>
                    
                    <div class="widget">
                        <h4>Thông tin tác giả</h4>
                        <div class="author-info">
                            <div class="author-avatar">
                                <i class="fa fa-user-circle"></i>
                            </div>
                            <div class="author-details">
                                <h5>{{ $news->author->name }}</h5>
                                <p>Thành viên VietNamPool</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.news-article {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.article-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

.article-content {
    padding: 2rem;
}

.article-excerpt {
    background: #f8f9fa;
    padding: 1.5rem;
    border-left: 4px solid #21324C;
    margin-bottom: 2rem;
    font-style: italic;
    font-size: 1.1rem;
    color: #666;
}

.article-body {
    line-height: 1.8;
    font-size: 1.1rem;
    color: #000000 !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    font-weight: normal !important;
}

.article-body img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 20px 0;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.article-body h1, .article-body h2, .article-body h3, .article-body h4, .article-body h5, .article-body h6 {
    margin-top: 30px;
    margin-bottom: 15px;
    color: #000000 !important;
    font-weight: bold !important;
}

.article-body p {
    margin-bottom: 15px;
    text-align: justify;
    color: #000000 !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    font-weight: normal !important;
}

.article-body ul, .article-body ol {
    margin-bottom: 15px;
    padding-left: 30px;
    color: #000000 !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    font-weight: normal !important;
}

.article-body blockquote {
    border-left: 4px solid #ff6b35;
    padding-left: 20px;
    margin: 20px 0;
    font-style: italic;
    background: #f8f9fa;
    padding: 15px 20px;
    border-radius: 5px;
    color: #000000 !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
}

.article-body table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.article-body table th,
.article-body table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
    color: #000000 !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    font-weight: normal !important;
}

.article-body table th {
    background-color: #f8f9fa;
    font-weight: bold !important;
    color: #000000 !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
}

.article-body a {
    color: #ff6b35;
    text-decoration: none;
}

.article-body a:hover {
    text-decoration: underline;
}

.article-body p {
    margin-bottom: 1.5rem;
    color: #000000 !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    font-weight: normal !important;
}

/* Đảm bảo tất cả văn bản trong nội dung bài báo có màu đen */
.article-body * {
    color: #000000 !important;
}

/* Đảm bảo các thẻ văn bản có phông chữ dễ đọc */
.article-body div, 
.article-body span, 
.article-body strong, 
.article-body em, 
.article-body b, 
.article-body i {
    color: #000000 !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
}

/* Đảm bảo các thẻ strong và b có font-weight bold */
.article-body strong, 
.article-body b {
    font-weight: bold !important;
}

.article-footer {
    padding: 2rem;
    border-top: 1px solid #eee;
    background: #f8f9fa;
}

.share-buttons h5 {
    margin-bottom: 1rem;
    color: #21324C;
}

.share-buttons .btn {
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}

.post-meta {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    margin-top: 1rem;
    font-size: 0.9rem;
    color: #666;
}

.post-meta span {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.post-meta i {
    color: #21324C;
}

.sidebar {
    position: sticky;
    top: 2rem;
}

.widget {
    background: white;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.widget h4 {
    color: #21324C;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #21324C;
}

.related-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.related-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.related-image {
    width: 80px;
    height: 60px;
    border-radius: 5px;
    overflow: hidden;
    flex-shrink: 0;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-content h5 {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    line-height: 1.4;
}

.related-content h5 a {
    color: #21324C;
    text-decoration: none;
    transition: color 0.3s ease;
}

.related-content h5 a:hover {
    color: #2d7d32;
}

.related-date {
    font-size: 0.8rem;
    color: #666;
}

.author-info {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.author-avatar {
    font-size: 3rem;
    color: #21324C;
}

.author-details h5 {
    margin-bottom: 0.5rem;
    color: #21324C;
}

.author-details p {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
}

@media (max-width: 768px) {
    .post-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .article-content {
        padding: 1.5rem;
    }
    
    .article-footer {
        padding: 1.5rem;
    }
    
    .share-buttons .btn {
        display: block;
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection
