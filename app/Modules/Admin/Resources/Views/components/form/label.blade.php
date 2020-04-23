@php
    $is_must= array_get($params,'must',0);
    $result = array_get($params,'rq',"0");

    if ($result != "0" ) {
        $data =  explode('|', $result);
        if (empty($data)) {
            $is_must = 0;
        } else {
            $data = array_flip($data);
            if (isset($data['rq']) || isset($data['rqu'])) {
              $is_must = 1;
            } else {
              $is_must = 0;
            }
        }
    }
@endphp
<label class="layui-form-label">
    @if($is_must)<strong class="item-required">*</strong>@endif
    {{ array_get($params,'title','')}}{!! isset($params['mark'])?$params['mark']?'<span style="font-size:12px">('.$params['mark'].')</span>':'':''  !!}
</label>
