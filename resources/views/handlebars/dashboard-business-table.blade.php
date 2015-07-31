<script id="businessesTemplate" type="text/x-handlebars-template">
              <table id="businessesTable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Business Name</th>
                        <th>Description</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Website</th>
                      </tr>
                    </thead>
                    <tbody>
                    @{{#each businesses}}
                      <tr>
                        <td>@{{name}}</td>
                        <td>@{{description}}</td>
                        <td>@{{telephone}}</td>
                        <td>@{{address}}</td>
                        <td>@{{link}}</td>
                      </tr>
                    @{{/each}}
                    </tbody>
                  </table>
</script>