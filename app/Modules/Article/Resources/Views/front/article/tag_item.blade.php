@if(isset($article['tags']) && count($article['tags']) > 0)
    <div class="tags">
                @foreach($article['tags'] as $tag)
            <a href="{{route('tags.show', ['tag' => $tag['tag']['hash_id']])}}"
               target="_blank">{{$tag['tag']['nickname'] ?? ''}}</a>
        @endforeach
            </div>
@endif
