<table id="linkTable" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Logo</th>
      <th>Social Network</th>
      <th>Profile URL</th>
      <th width="65">Action</th>
    </tr>
  </thead>
  <tbody>
    @{{#each links}}
      <tr>
        <td><img src="@{{logo}}" width="50"></td>
        <td>@{{name}}</td>
        <td><a href="@{{pivot.url}}" target="_blank">@{{pivot.url}}</td>
        <td class="action">
          <a onclick="cc.crud.link.edit.edit(@{{id}})">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </a>
          <a onclick="cc.crud.link.destroy(@{{id}})">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </a>
        </td>
      </tr>
    @{{/each}}
  </tbody>
</table>

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