<table id="businessesTable" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Name</th>
      <th>Admin</th>
      <th>Address</th>
      <th>Website</th>
      <th width="45">Action</th>
    </tr>
  </thead>
  <tbody>
    @{{#each businesses}}
      <tr>
        <td>@{{name}}</td>
        <td>@{{admin.name}}</td>
        <td>@{{location}}</td>
        <td><a href="@{{url}}" target="_blank">@{{url}}</td>
        <td class="action">
          <!--<a onclick="cc.crud.business.show(@{{id}})">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
          </a>
          -->
          <a onclick="cc.crud.business.edit.edit(@{{id}})">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </a>
          <a onclick="cc.crud.business.destroy(@{{id}})">
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