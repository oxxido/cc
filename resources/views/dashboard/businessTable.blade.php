<script id="businessesTemplate" type="text/x-handlebars-template">
  <table id="businessesTable" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Admin</th>
        <th>Address</th>
        <th>Website</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @{{#each businesses}}
        <tr>
          <td>@{{name}}</td>
          <td>@{{admin.name}}</td>
          <td>@{{location}}</td>
          <td><a href="@{{url}}" target="_blank">@{{url}}</td>
          <td>
            <span class="glyphicon glyphicon-search" aria-hidden="true" onclick="alert('hola')"></span>
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </td>
        </tr>
      @{{/each}}
    </tbody>
  </table>
</script>