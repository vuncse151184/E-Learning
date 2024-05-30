@extends('user.layouts.app')
@section('content')
    <main id="content" class="mt-5">
        <a class="anchor" name="anchor_17945"></a>

        <div id="pmid_17945" class="Edu\Modules\AnonymousHomepage\AnonymousHomepage">
            <div class="carousel-section homepage-section">
                <div class="content-types page-width mt-4">
                    @foreach ($lessons as $item)
                        <div class="content-type">
                            <div class="content-header">
                                <img class="align-middle d-inline"
                                    src="https://cdn.education.com/files/static/homepage/icons/lessonPlans.svg">
                                <div class="align-middle d-inline">{{ $item->lesson_name }}</div>
                            </div>
                            <div class="content-description">
                                Biên soạn bởi: &nbsp;<span class="font-weight-bold">{{ $item->teacher_name }}</span>
                            </div>
                            <div class="buttonContainer">
                                <div class="spacer"></div>
                                <a class="btn btn-primary btn-magenta" href="{{ url('/viewlesson/' . $item->id) }}">Học</a>
                                <div class="spacer"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </main>
@endsection
