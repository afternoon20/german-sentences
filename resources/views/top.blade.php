@extends('_include.layout')

@section('content')
    <div class="container mt-4 mb-4">
        @if (!empty($error))
            <div class="p-error">
                <div class="p-list__warning  red lighten-4 p-2 mb-3">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif
        <h1>問題出題</h1>
        <div class="row">
            <div class="m10 s12">
                <form action="{{ url('/', null) }}/" method="get">
                    <div class="p-search p-3 grey lighten-4">
                        <div class="row valign-wrapper">
                            <div class="s12 mb-4">
                                <div class="input-field">
                                    <select id="form-select" name="lesson_id[]" multiple>
                                        {{-- TODO: <option value="" class="select-all">すべて選択</option> --}}
                                        @foreach ($lessons as $index => $lesson)
                                            <option value={{ $lesson->lesson_id }} @if (in_array($lesson->lesson_id, data_get($params, 'lesson_id', [0]))) selected @endif>第{{ $lesson->reference_order_no }}課:{{ $lesson->lesson_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($lessons)
                                        <label for="form-select">出題範囲を選択してください。</label>
                                    @else
                                        <label for="form-select">出題範囲がありません。</label>
                                    @endif
                                </div>
                            </div>
                            <div class="s12">
                                <div class="row valign-wrapper">
                                    <div class="m6 s12">
                                        <p>
                                            @auth
                                                <label>
                                                    <input type="checkbox" name="is_favorite" value="1" @if (data_get($params, 'is_favorite')) checked @endif />
                                                    <span>お気に入りのみ出題</span>
                                                </label>
                                            @endauth
                                            @guest
                                                <label>
                                                    <span class="red-text">ログインするとお気に入りでの絞り込みができます。</span>
                                                </label>
                                            @endguest
                                        </p>
                                    </div>
                                    <div class="m6 s12">
                                        <div class="col m2 s12 ml-4 right-align">
                                            <button type="submit" class="waves-effect btn">
                                                <i class="material-icons-outlined left mr-1">question_answer</i>出題する
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                        @php
                            $questionCnt = 1;
                        @endphp
                        <div class="switch p-2 mb-3">
                            <label>
                                正解を表示
                                <input class="answer-switch" type="checkbox" name="answer-switch" value="1">
                                <span class="lever ml-1"></span>
                            </label>
                        </div>
                        @foreach ($questions as $question)
                            <div class="section p-2 p-list">
                                <p class="p-list__question">({{ $questionCnt }}) {{ $question->question_question }}</p>
                                <p class="mb-1 p-list__answer red-text">{{ $question->question_answer }}</p>
                                <div class="p-list__footer mb-2">
                                    <div class="row valign-wrapper mb-0">
                                        <div class="col s4">
                                            <div class="row">
                                                @auth
                                                    <div class="s12">
                                                        <small class="mr-2"><span class="red-text">あなた</span>の正答率
                                                            @if (is_null(data_get($questionUserCorrectRate, $question->question_id)))
                                                                -
                                                            @else
                                                                {{ data_get($questionUserCorrectRate, $question->question_id) }}% ({{ $question2rates[$question->question_id]->rate_correct }}/{{ $question2rates[$question->question_id]->rate_correct + $question2rates[$question->question_id]->rate_incorrect }})
                                                            @endif
                                                        </small>
                                                    </div>
                                                @endauth
                                                <div class="s12">
                                                    <small class="mr-2">全体の正答率
                                                        @if (is_null(data_get($questionCorrectRate, $question->question_id)))
                                                            -
                                                        @else
                                                            {{ data_get($questionCorrectRate, $question->question_id) }}% ({{ $question->question_correct }}/{{ $question->question_correct + $question->question_incorrect }})
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s4">
                                            <small class="p-list__lesson">第{{ $lessons[$question->question_lesson_id]->reference_order_no }}課 {{ $lessons[$question->question_lesson_id]->lesson_name }} {{ $question->question_page }}ページ</small>
                                        </div>
                                        <div class="col s4 offset-s7 offset-m9 left-align">
                                            <div class="p-list__icons right-align" question-data={{ $question->question_id }}>
                                                <span class="p-list__icon p-list__icon--rate p-list__icon--thumb_up mr-3 mb-0 material-icons grey-text text-lighten-1">thumb_up</span>
                                                <span class="p-list__icon p-list__icon--rate p-list__icon--thumb_down mr-3 mb-0 material-icons grey-text text-lighten-1">thumb_down</span>
                                                @auth
                                                    <span class="p-list__icon p-list__icon--favorite mr-3 mb-0 material-icons-outlined text-lighten-1 @if (data_get($question2favorites, $question->question_id)) p-list__icon--favorited pink-text @else grey-text @endif">favorite</span>
                                                @endauth
                                                {{-- <span class="p-list__icon p-list__icon--content_copy mr-3 mb-0 material-icons">content_copy</span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                            </div>
                            @php
                                $questionCnt++;
                            @endphp
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
