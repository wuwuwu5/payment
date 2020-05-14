<li class="item">
    <h2 class="title">
        <a href="{{route('articles.show', ['article' => $article['hash_id']])}}" target="_blank">
            <i class="ico-tag"> 最新 </i>
            {{$article['title']}}
        </a>
    </h2>
    <h4>
        <i class="time">{{ \Carbon\Carbon::parse($article['published_at'])->diffForHumans() }}</i>
        <i class="author">推荐：
            <a href="" target="_blank">  {{$article['creator']['username'] ?? ''}} </a>
        </i>

        @if(isset($article['tags']) && count($article['tags']) > 0)
            <span class="tags">
                @foreach($article['tags'] as $tag)
                    <a href="{{route('tags.show', ['tag' => $tag['tag']['hash_id']])}}"
                       target="_blank">{{$tag['tag']['nickname'] ?? ''}}</a>
                @endforeach
            </span>
        @endif
    </h4>
</li>
