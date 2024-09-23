<div class="form-group col-md-4">
    <label for="inputZip"><b>Post Count</b></label> : &nbsp; {{ $posts->count() }}

   </div>
    <table class="table datatables" id="">
        <thead>
        <tr>
            <th>Post</th>
            <th>Category</th>
            <td>Viwers</td>
            <th>Publisher</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
            <tr class="lodder d-none">
                <td></td>
                <td></td>
                <td>
                    <center>
                        <img src="{{ asset('assets/Spinner-1s-200px.gif') }}" style="max-width: 100px;" alt="">
                    </center>
                </td>
                <td></td><td></td>
            </tr>
            @if ($posts->count())
                @foreach ($posts as $post )
                <tr>
                    <td>{{ $post->name }}</td>
                    <td>
                        @foreach ($post->get_ID as $category )
                        @if (!$loop->index == 0)
                            ,
                        @endif
                        {{ $category->category->name }}

                        @endforeach

                    </td>
                    <td>{{ $post->views }}</td>
                    <td>{{ $post->user->name }}</td>


                    <td>{{ date('M d,Y', strtotime(strval( $post->publish_at ))) }}</td>
                </tr>
                @endforeach
            @else
            <tr>
                <td colspan="12"><center>No Data Found</center></td>
            </tr>
            @endif


        </tbody>
    </table>



