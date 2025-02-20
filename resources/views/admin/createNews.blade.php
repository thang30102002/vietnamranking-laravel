<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Thêm tin tức</title>
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('images/adminTournament/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/feathericon.min.css') }}">
    <link rel="stylehseet" href="https://cdn.oesmith.co.uk/morris-0.5.1.css">
    <link rel="stylesheet" href="{{ asset('plugins/adminTournament/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminTournament/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
</head>

<body>

    <div class="main-wrapper">
        <x-notification />
        <x-admin.menu />
        <x-admin.sidebar />

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title mt-5">Thêm tin tức</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action={{ route('news.create') }} enctype="multipart/form-data">
                            @csrf
                            <div class="row formtype">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input class="form-control" type="text" name="title"
                                            value="{{ old('title') }}">
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input class="form-control" type="text" name="slug"
                                            value="{{ old('slug') }}">
                                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Chủ đề</label>
                                        <select class="form-control" id="topic_id" name="topic_id">
                                            @foreach ($topics as $topic)
                                                <option value="{{ $topic->id }}"
                                                    {{ old('topic_id') == $topic->id ? 'selected' : '' }}>
                                                    {{ $topic->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('topic_id')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ảnh</label>
                                        <input type="file" name="img" value="{{ old('img') }}"
                                            accept="image/*"
                                            class="search-input w-full py-[6px] px-[12px] text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="File ảnh cơ thủ" />
                                        <div
                                            class="search-results mt-3 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                                        </div>
                                    </div>
                                </div>

                                <x-input-error :messages="$errors->get('img')" class="mt-2" />
                                <div class="form-group w-full pl-[15px] pr-[15px]">
                                    <label>Nội dung</label>
                                    <textarea name="content" id="editor">{{ old('content') }}</textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary buttonedit">Cập nhật</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <script>
        CKEDITOR.replace('editor');
    </script>

    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/select2.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/raphael/raphael.min.js"></script>

    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/js/script.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('js/adminTournament/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/popper.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/adminTournament/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/adminTournament/raphael/raphael.min.js') }}"></script>
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="{{ asset('js/adminTournament/chart.morris.js') }}"></script>
    <script src="{{ asset('js/adminTournament/script.js') }}"></script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'

            });
        });
    </script>
</body>

</html>
