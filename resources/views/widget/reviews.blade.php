<ul class="list-group">
  @{{#each comments}}
    <li class="list-group-item comment">
      <div class="row">
        <div class="col-md-8 comment">@{{comment}}</div>
        <div class="col-md-4">
          @{{commenter.name}}<br>
          Rating: @{{rating}}
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
