<div class="card color-black">
    <div class="card-header">
        {{trans('home.LEVEL 2')}}
        <a href="{{route('index')}}" type="button"
           class="btn btn-danger float-right ml-2">{{trans('home.Exit game')}}</a>
        <a href="{{route('gameIntro', $language->lang_code)}}" type="button"
           class="btn btn-secondary float-right mr-2"
           style="color: white; margin-right: 5px;">{{trans('home.Level choose')}}</a>
    </div>
    <div class="card-body">
        <form id="form-{{$submit}}"
              action="{{route('answerLevel2', ['code' => $language->lang_code, 'level' => $level])}}"
              method="POST">
            @csrf
            @method('POST')
            @if($level == 2 || $level == '2+3')
                <h4>{{trans('home.Why can\'t this sentence be used for teaching X?')}}</h4>
            @else
                <h4>{{trans('home.Why not this one?')}}</h4>
            @endif
            <p class="sentence">{{$sentence->sentence}}</p>
            <input type="hidden" name="sentenceId" value="{{$sentence->id}}"/>
            <input type="hidden" name="answerId" value="{{$answerId}}"/>
            @if(is_array($answersIds))
                @foreach($answersIds as $item)
                    <input type="hidden" name="answersIds[]" value="{{$item}}"/>
                @endforeach
            @else
                <input type="hidden" name="answersIds" value="{{$answersIds}}"/>
            @endif
            <div class="form-check sentence">
                <input class="form-check-input answer" type="checkbox" id="offensive" name="answer[]"
                       value="offensive">
                <label class="form-check-label" for="offensive">
                    {{trans('home.Offensive')}}
                </label>
                <span class="show-tool-tip" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right"
                      title="{{trans('home.XXXX - offensive')}}"><svg height="16" width="16"
                                                                      viewBox="0 0 16 16"><path
                            fill="#skin_color_information"
                            d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM8.9 13h-2v-2h2v2zM11 8.1c-0.4 0.4-0.8 0.6-1.2 0.7-0.6 0.4-0.8 0.2-0.8 1.2h-2c0-2 1.2-2.6 2-3 0.3-0.1 0.5-0.2 0.7-0.4 0.1-0.1 0.3-0.3 0.1-0.7-0.2-0.5-0.8-1-1.7-1-1.4 0-1.6 1.2-1.7 1.5l-2-0.3c0.1-1.1 1-3.2 3.6-3.2 1.6 0 3 0.9 3.6 2.2 0.4 1.1 0.2 2.2-0.6 3z"></path></svg><small
                        class="tooltip-title"
                        style="display: none; margin-left: 5px;">{{trans('home.XXXX - offensive')}}</small></span>
            </div>
            <div class="form-check sentence">
                <input class="form-check-input answer" type="checkbox" id="vulgar" name="answer[]"
                       value="vulgar">
                <label class="form-check-label" for="vulgar">
                    {{trans('home.Vulgar')}}
                </label>
                <span class="show-tool-tip" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right"
                      title="{{trans('home.XXXX- vulgar')}}"><svg height="16" width="16" viewBox="0 0 16 16"><path
                            fill="#skin_color_information"
                            d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM8.9 13h-2v-2h2v2zM11 8.1c-0.4 0.4-0.8 0.6-1.2 0.7-0.6 0.4-0.8 0.2-0.8 1.2h-2c0-2 1.2-2.6 2-3 0.3-0.1 0.5-0.2 0.7-0.4 0.1-0.1 0.3-0.3 0.1-0.7-0.2-0.5-0.8-1-1.7-1-1.4 0-1.6 1.2-1.7 1.5l-2-0.3c0.1-1.1 1-3.2 3.6-3.2 1.6 0 3 0.9 3.6 2.2 0.4 1.1 0.2 2.2-0.6 3z"></path></svg><small
                        class="tooltip-title"
                        style="display: none; margin-left: 5px;">{{trans('home.XXXX- vulgar')}}</small></span>
            </div>
            <div class="form-check sentence">
                <input class="form-check-input answer" type="checkbox" id="sensitiveContent"
                       name="answer[]"
                       value="sensitiveContent">
                <label class="form-check-label" for="sensitiveContent">
                    {{trans('home.Sensitive content')}}
                </label>
                <span class="show-tool-tip" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right"
                      title="{{trans('home.XXXX - sensitive content')}}"><svg height="16" width="16"
                                                                              viewBox="0 0 16 16"><path
                            fill="#skin_color_information"
                            d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM8.9 13h-2v-2h2v2zM11 8.1c-0.4 0.4-0.8 0.6-1.2 0.7-0.6 0.4-0.8 0.2-0.8 1.2h-2c0-2 1.2-2.6 2-3 0.3-0.1 0.5-0.2 0.7-0.4 0.1-0.1 0.3-0.3 0.1-0.7-0.2-0.5-0.8-1-1.7-1-1.4 0-1.6 1.2-1.7 1.5l-2-0.3c0.1-1.1 1-3.2 3.6-3.2 1.6 0 3 0.9 3.6 2.2 0.4 1.1 0.2 2.2-0.6 3z"></path></svg><small
                        class="tooltip-title"
                        style="display: none; margin-left: 5px;">{{trans('home.XXXX - sensitive content')}}</small></span>
            </div>
            <div class="form-check sentence">
                <input class="form-check-input answer" type="checkbox" id="spelling and/or grammar problems"
                       name="answer[]"
                       value="spelling and/or grammar problems">
                <label class="form-check-label" for="spelling and/or grammar problems">
                    {{trans('home.Spelling and/or grammar problems')}}
                </label>
                <span class="show-tool-tip" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right"
                      title="{{trans('home.XXXX- Spelling/grammar problems')}}"><svg height="16" width="16"
                                                                                     viewBox="0 0 16 16"><path
                            fill="#skin_color_information"
                            d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM8.9 13h-2v-2h2v2zM11 8.1c-0.4 0.4-0.8 0.6-1.2 0.7-0.6 0.4-0.8 0.2-0.8 1.2h-2c0-2 1.2-2.6 2-3 0.3-0.1 0.5-0.2 0.7-0.4 0.1-0.1 0.3-0.3 0.1-0.7-0.2-0.5-0.8-1-1.7-1-1.4 0-1.6 1.2-1.7 1.5l-2-0.3c0.1-1.1 1-3.2 3.6-3.2 1.6 0 3 0.9 3.6 2.2 0.4 1.1 0.2 2.2-0.6 3z"></path></svg><small
                        class="tooltip-title"
                        style="display: none; margin-left: 5px;">{{trans('home.XXXX- Spelling/grammar problems')}}</small></span>
            </div>
            <div class="form-check sentence">
                <input class="form-check-input answer" type="checkbox"
                       id="lack of context and/or incomprehensible"
                       name="answer[]" value="lack of context and/or incomprehensible">
                <label class="form-check-label" for="lack of context and/or incomprehensible">
                    {{trans('home.Lack of context and/or incomprehensible')}}
                </label>
                <span class="show-tool-tip" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right"
                      title="{{trans('home.XXXX-Lack of context/incomprehensible')}}"><svg height="16"
                                                                                           width="16"
                                                                                           viewBox="0 0 16 16"><path
                            fill="#skin_color_information"
                            d="M8 0c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM8.9 13h-2v-2h2v2zM11 8.1c-0.4 0.4-0.8 0.6-1.2 0.7-0.6 0.4-0.8 0.2-0.8 1.2h-2c0-2 1.2-2.6 2-3 0.3-0.1 0.5-0.2 0.7-0.4 0.1-0.1 0.3-0.3 0.1-0.7-0.2-0.5-0.8-1-1.7-1-1.4 0-1.6 1.2-1.7 1.5l-2-0.3c0.1-1.1 1-3.2 3.6-3.2 1.6 0 3 0.9 3.6 2.2 0.4 1.1 0.2 2.2-0.6 3z"></path></svg><small
                        class="tooltip-title"
                        style="display: none; margin-left: 5px;">{{trans('home.XXXX-Lack of context/incomprehensible')}}</small></span>
            </div>
            @if($level == 2 || $level == '2+3')
                <div class="form-check sentence">
                    <input class="form-check-input answer" type="checkbox"
                           id="{{$fine}}"
                           name="answer[]" value="fine">
                    <label class="form-check-label" for="fine">
                        {{trans('home.This sentence is fine')}}
                    </label>
                </div>
            @endif
            <button id="{{$submit}}" type="submit" class="btn btn-primary mt-3">{{trans('home.Choose')}}</button>
            @include('web.shared.game-bottom-data')
        </form>
    </div>
</div>
