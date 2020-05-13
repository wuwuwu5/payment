<div class="top-cats hide_sm">
    <div class="container">
        <div class="items">
            <ul>
                <li class="item">
                    <a class="" href="{{route('articles.column.show', ['type' => 'all'])}}" target="_blank">
                        <i class="icon icon-allposts"></i>
                        全部
                    </a>
                </li>
                @php
                    $parent = $columns[0]??[];
                    $current = $columns[count($columns) - 1]??[];
                    if (empty($parent)) {
                        $children = [];
                    } else {
                        $children = getFrontChildrenColumns($parent['id']);
                    }
                @endphp
                @foreach($children as $child)
                    <li class="item">
                        <a class="{{($current['id'] ?? '') == ($child['id'] ?? -1) ? 'current' : ''}}"
                           href="{{route('articles.column.show', ['type' => $child['mark_name']])}}"
                           target="_blank">
                            <i class="icon icon-allposts"></i>
                            {{$child['name']}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
