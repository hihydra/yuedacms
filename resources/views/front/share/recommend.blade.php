<div class="Recommend-book M1">
  <div class="hot-h2">
    <h2>
      <p>{{trans('front/system.commend')}}</p>
    </h2>
  </div>
  <div class="Recommend-list">
    <ul>
      @foreach($datas as $commend)
      <li>
        <div class="book">
          <a href="#"><img src="{{{$commend['thumbUrl'] or defaultImg()}}}" /></a>
          <a href="#" class="tittle">{{str_limit($commend['name'], $limit = 25, $end = '...')}}</a>
        </div>
        <div class="info">
          <p class="author">{{$commend['author']}}</p>
          <p class="price">￥{{$commend['price']}}</p>
        </div>
      </li>
      @endforeach
      <div class="clear"></div>
    </ul>

  </div>
</div>