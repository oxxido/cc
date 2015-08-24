<table id="adminTable" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th width="45">Action</th>
    </tr>
  </thead>
  <tbody>
    @{{#each admins}}
      <tr>
        <td>@{{name}}</td>
        <td>@{{email}}</td>
        <td class="action">
          <!-- <a onclick="cc.crud.admin.show(@{{id}})">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
          </a> -->
          <a onclick="cc.crud.admin.edit.edit(@{{id}})">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </a>
          <a onclick="cc.crud.admin.destroy(@{{id}})">
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