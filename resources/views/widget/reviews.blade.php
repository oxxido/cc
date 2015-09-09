<ul class="list-group">
  @{{#each comments}}
    <li class="list-group-item comment">
      <div class="row">
        <div class="col-xs-8 comment">@{{comment}}</div>
        <div class="col-xs-2">
          @{{commenter.name}}<br>
          <input type="text" class="rating" data-size="xxs" readonly data-show-clear="false" data-show-caption="false" value="@{{rating}}">
          @{{created}}
        </div>
        <div class="col-xs-2">
          <a role="button" data-toggle="popover" 
            data-placement="left"
            data-html="true" 
            data-content="<div class='bg-text'>We validated the testimonial from data collected from the customer including but not limited to:</div><table class='certification-table'><tr class='first-row'><td class='first-col'>IP: 50.xxx.xxx.17</td><td>Phone: 570-xxx-xxxx</td></tr><tr><td class='first-col'>State: Pennsylvania</td><td>Email: XXXX@hotmail.com</td></tr></table>"
            title="<img src='/images/certification.png' alt='certification'>"><img src="/images/certification.gif" alt="certification"></a>
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

