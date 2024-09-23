<div class="form-group col-md-4"></div>

<table class="table datatables" id="">

    <thead>
        <tr>
            <th>Publisher ID</th>
            <th>Publisher Name</th>
            <th>Total Posts</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($results) && count($results))
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->id }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->total_posts }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3"><center>No Data Found</center></td>
            </tr>
        @endif
    </tbody>
</table>
