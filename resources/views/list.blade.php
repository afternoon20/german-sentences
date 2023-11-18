@extends('_include.layout')

@section('content')
    <div class="container mt-4 mb-4">
        <h1>問題一覧</h1>
        <div class="row">
            <div class="m10 s12">
                <form action="{{ url('/list', null) }}/" method="get">
                    <div class="p-search p-3 grey lighten-4">
                        <div class="row valign-wrapper">
                            <div class="m10 s12 mr-2 mb-2">
                                <div class="input-field">
                                    <select id="form-select" name="question_lesson_id">
                                        @foreach ($lessons as $index => $lesson)
                                            <option value={{ $lesson->lesson_id }} @if (data_get($params, 'question_lesson_id') == $lesson->lesson_id) selected @endif>第{{ $lesson->reference_order_no }}課:{{ $lesson->lesson_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($lessons)
                                        <label for="form-select">出題範囲を選択してください。</label>
                                    @else
                                        <label for="form-select">出題範囲がありません。</label>
                                    @endif
                                </div>
                            </div>
                            <div class="m2 s12 center-align">
                                <button type="submit" class="waves-effect btn">
                                    <i class="material-icons-outlined left mr-1">search</i>検索
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="sentence mt-5 mb-5">
                    @if (!count($questions))
                        <div class="p-list__warning amber lighten-4 p-2">
                            <p>問題がありません。</p>
                        </div>
                    @else
                        <div class="switch p-2 mb-3">
                            <label>
                                正解を表示
                                <input class="answer-switch" type="checkbox" name="answer-switch" value="1">
                                <span class="lever ml-1"></span>
                            </label>
                        </div>
                        @foreach ($questions as $question)
                            <div class="section p-2 p-list">
                                <p class="p-list__question">{{ $question->question_question }}</p>
                                <p class="mb-1 p-list__answer red-text">{{ $question->question_answer }}</p>
                                <div class="p-list__footer--list  pb-2">
                                    <div class="row valign-wrapper">
                                        <div class="col m4 s12">
                                            <div class="row">
                                                @auth
                                                    <div class="s12">
                                                        <small class="mr-2"><span class="red-text">あなた</span>の正答率
                                                            @if (is_null(data_get($questionCorrectRate, $question->question_id, null)))
                                                                -
                                                            @else
                                                                {{ data_get($questionCorrectRate, $question->question_id) }}% ({{ $question->question_correct }}/{{ $question->question_correct + $question->question_incorrect }})
                                                            @endif
                                                        </small>
                                                    </div>
                                                @endauth
                                                <div class="s12">
                                                    <small class="mr-2">全体の正答率
                                                        @if (is_null(data_get($questionCorrectRate, $question->question_id, null)))
                                                            -
                                                        @else
                                                            {{ data_get($questionCorrectRate, $question->question_id) }}% ({{ $question->question_correct }}/{{ $question->question_correct + $question->question_incorrect }})
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col m4 s12">
                                            <small class="p-list__lesson">第{{ $lessons[$question->question_lesson_id]->reference_order_no }}課 {{ $lessons[$question->question_lesson_id]->lesson_name }} {{ $question->question_page }}ページ</small>
                                        </div>
                                        <div class="col m4 offset-s7 offset-m9 left-align">
                                            <div class="right-align">
                                                @auth
                                                    <span class="p-list__icon p-list__icon--favorite mr-3 material-icons-outlined pink-text text-lighten-2">favorite</span>
                                                @endauth
                                                {{-- <span class="p-list__icon p-list__icon--content_copy mr-3 mb-0 material-icons">content_copy</span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
