<table id="businessesTable" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Active</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @{{#each users}}
      <tr>
        <td>@{{first_name}}</td>
        <td>@{{last_name}}</td>
        <td>@{{email}}</td>
        <td><a href="@{{url}}" target="_blank">@{{url}}</td>
        <td>
          <a onclick="cc.user.edit.edit(@{{id}})">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
          </a>
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        </td>
      </tr>
    @{{/each}}
  </tbody>
</table>
