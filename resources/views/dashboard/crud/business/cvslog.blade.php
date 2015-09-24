<table class="table table-condensed table-hover">
  @{{#each results}}
    @{{#if errors}}
      <tr>
        <td class="danger">
          Error on create business: <b>@{{line.name}}</b>
          <ul>
            @{{#each errors}}
              <li>@{{this}}</li>
            @{{/each}}
          </ul>
        </td>
      </tr>
    @{{else}}
      <tr>
        <td class="success">
          Creted business: <b>@{{business.name}}</b>
          <ul>
            @{{#each logs}}
              <li>@{{this}}</li>
            @{{/each}}
          </ul>
        </td>
      </tr>
    @{{/if}}
  @{{/each}}
</tableul>
