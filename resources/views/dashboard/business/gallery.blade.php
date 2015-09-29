@{{#if images}}
  <div class="row">
    @{{#each images}}
      <div class="col-xs-6 col-md-3">
        <a href="javascript:;" class="thumbnail" onclick="cc.bizfeed.selected(this)" data-image="@{{this}}">
          <img src="@{{this}}" alt="Image">
        </a>
      </div>
    @{{/each}}
  </div>
@{{else}}
  <p class="text-center">Images not found</p>
@{{/if}}