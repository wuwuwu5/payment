<div class="list-item-default flex">
    <div class="item-thumb">
        <a href="articles/show/{{$article['hash_id']}}" class="h-scale" target="_blank">
            <i class="thumb "
               style="background-image:url('{{render_cover($article['cover'])}}')"></i>
        </a>
    </div>
    <div class="item-content">
        <a href="collage-design.html" class="a_block" target="_blank">
            @if(\Carbon\Carbon::parse($article['published_at'])->diffInDays(now()) == 0)
                <span class="new btn-orange-border">最新</span>
            @endif
            <h2 class="title"> {{$article['title']}} </h2>
            <p>{{$article['short_title']}}</p>
        </a>
        <h4>
            <i class="time">{{ \Carbon\Carbon::parse($article['published_at'])->diffForHumans() }}</i>
            <i class="author hide_sm">
                {{$article['creator']['username'] ?? ''}} </i>
            @if(isset($article['tags']) && count($article['tags']) > 0)
                <i class="tags">
                    @foreach($article['tags'] as $tag)
                        <a href="tag/{{$tag['tag']['name'] ?? ''}}"
                           target="_blank">{{$tag['tag']['nickname'] ?? ''}}</a>
                    @endforeach
                </i>
            @endif
        </h4>
    </div>
</div>
