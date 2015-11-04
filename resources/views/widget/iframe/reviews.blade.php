<ul class="list-group" id="reviews">
  @{{#each comments}}
    <li class="list-group-item">
      <div class="row">
        <div class="col-sm-8 comment">@{{comment}}</div>
        <div class="col-sm-4 commenter">
          @{{commenter.user.name}} |
          <input type="text" class="rating" data-size="xxs" readonly data-show-clear="false" data-show-caption="false" value="@{{rating}}"> |
          @{{created}}<br/>
          <a role="button" tabindex="0" data-toggle="popover" data-placement="bottom" data-html="true" data-content="" data-trigger="focus"
            title='<img src="/images/certification.png" alt="certification">'><img src="/images/certification.gif" alt="certification"></a>
          <div class="popover-data-content">
            <div class="bg-text">We validated the testimonial from data collected from the customer including but not limited to:</div>
            <table class="certification-table">
              <tr class="first-row">
                <td class="first-col">IP: @{{ip}}</td>
                <td>Phone: @{{commenter.phone}}</td>
              </tr>
              <tr>
                <td class="first-col">State: @{{commenter.city.state.name}}</td>
                <td>Email: @{{commenter.user.email}}</td>
              </tr>
            </table>
          </div>
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
