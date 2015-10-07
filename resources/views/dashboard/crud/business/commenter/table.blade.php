@if ($commenters_page->isEmpty())
    <h3 class="box-title">There are no customers set for this business</h3>
@else
    <table id="businessesTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>Added by</th>
                <th>Nº of tries</th>
                <th>Status</th>
                <th width="65">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($commenters_page as $commenter)
            <?php $business_commenter = $commenter->businessCommenter($business->id) ?>
            <tr>
                <td>{{ $commenter->name }}</td>
                <td>{{ $commenter->email }}</td>
                <td>{{ (null !== ($adder = App\Models\User::find($commenter->pivot->adder_id)))? $adder->name: '-'}}</td>
                <td>{{ $commenter->pivot->feedback_requests_sent }}</td>
                <td>{{ $business_commenter->status }}</td>
                <td class="action">
                    <div data-uuid="{{ $commenter->uuid }}" class="commenter-remove glyphicon glyphicon-remove link" aria-hidden="true"></div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <nav>
        {!! $commenters_page->render() !!}
    </nav>
@endif
