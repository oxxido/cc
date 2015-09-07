<ul class="list-group">
  @{{#each comments}}
    <li class="list-group-item comment">
      <div class="row">
        <div class="col-xs-8 comment">@{{comment}}</div>
        <div class="col-xs-4">
          @{{commenter.name}}<br>
          <input type="text" class="rating" data-size="xxs" readonly data-show-clear="false" data-show-caption="false" value="@{{rating}}">
          @{{created}}
        </div>
      </div>
    </li>
  @{{/each}}
</ul>
<nav>
  <ul id="paging" class="pagination">
    <li>Prev</li>
    <li>#n</li>
    <li>#n</li>
    <li>#c</li>
    <li>#n</li>
    <li>#n</li>
    <li>Next</li>
  </ul>
</nav>
