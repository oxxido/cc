@if ($commenters_page->isEmpty())
    <h3 class="box-title">There are no customers set for this business</h3>
@else
    <table id="businessesTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Added by</th>
                <th width="65">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($commenters_page as $commenter)
            <tr>
                <td>{{ $commenter->user->name }}</td>
                <td>{{ (null !== ($adder = App\Models\User::find($commenter->pivot->adder_id)))? $adder->name: '-'}}</td>
                <td class="action">
                    <a href="{{ URL::route('business.commenter.show', [$business, $commenter]) }}">
                        <span class="glyphicon glyphicon-search link" aria-hidden="true"></span>
                    </a>
                    <a href="{{ URL::route('business.commenter.edit', [$business, $commenter]) }}">
                        <span class="glyphicon glyphicon-pencil link" aria-hidden="true"></span>
                    </a>
                    <a href="{{ URL::route('business.commenter.destroy', [$business, $commenter]) }}">
                        <span class="glyphicon glyphicon-remove link" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <nav>
        {!! $commenters_page->render() !!}
    </nav>
@endif
