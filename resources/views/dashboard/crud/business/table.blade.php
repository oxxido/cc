@{{#if businesses}}
  <table id="businessesTable" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Admin</th>
        <th>Address</th>
        <th>Website</th>
        <th width="65">Action</th>
      </tr>
    </thead>
    <tbody>
      @{{#each businesses}}
        <tr>
          <td><a href="<?=url('dashbiz/{{uuid}}')?>">@{{name}}</a></td>
          <td>@{{admin.name}}</td>
          <td>@{{location}}</td>
          <td><a href="@{{url}}" target="_blank">@{{url}}</td>
          <td class="action">
            <a href="<?=url('dashbiz/{{uuid}}')?>">
              <span class="glyphicon glyphicon-search link" aria-hidden="true"></span>
            </a>
            <a onclick="cc.crud.business.edit.edit(@{{id}})">
              <span class="glyphicon glyphicon-pencil link" aria-hidden="true"></span>
            </a>
            <a onclick="cc.crud.business.destroy(@{{id}})">
              <span class="glyphicon glyphicon-remove link" aria-hidden="true"></span>
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
@{{else}}
  <p class="text-center"><i>There are no businesses set</i></p>
@{{/if}}