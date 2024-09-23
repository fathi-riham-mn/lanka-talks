<div class="form-group col-md-4">
    <label for="inputZip"><b>Post Count</b></label> : &nbsp; {{ $posts->count() }}
</div>
<table class="table datatables" id="">
    <thead>
    <tr>
        <th>Post</th>
        <th>Category</th>
        <td>Views</td>
        <th>Publisher</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
        @if (isset($noDataMessage) && $noDataMessage)
            <tr>
                <td colspan="5">
                    <center>{{ $noDataMessage }}</center>
                </td>
            </tr>
        @else
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->name }}</td>
                <td>
                    @foreach ($post->get_ID as $category)
                        @if (!$loop->first)
                            ,
                        @endif
                        {{ $category->category->name }}
                    @endforeach
                </td>
                <td>{{ $post->views }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ date('M d, Y', strtotime($post->publish_at)) }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
