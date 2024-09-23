@extends('layouts.app')

@section('main-content')
<div class="row justify-content-center">
    <div class="col-12">
      <!-- widgets -->
      <div class="row my-4">

          <div class="col-md-4">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-sm bg-primary">
                      <i class="fe fe-16 fe-users text-white mb-0"></i>
                    </span>
                  </div>
                  <div class="col pr-0">
                    <p class="small text-muted mb-0">Total Publisher</p>
                    <span class="h3 mb-0">{{ $users->count() }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-sm bg-primary">
                      <i class="fe fe-16 fe-bar-chart text-white mb-0"></i>
                    </span>
                  </div>
                  <div class="col pr-0">
                    <p class="small text-muted mb-0">Total Post</p>
                    <span class="h3 mb-0">{{ $blogs->count() }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow border-0">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-3 text-center">
                    <span class="circle circle-sm bg-primary">
                      <i class="fe fe-16 fe-trending-up text-white mb-0"></i>
                    </span>
                  </div>
                  <div class="col">
                    <p class="small text-muted mb-0">Total View</p>
                    <span class="h3 mb-0">{{ $views }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

      <div class="row my-4">
        <div class="col-md-8 mb-4">
          <div class="card shadow">
            <div class="card-header">
              <strong class="card-title mb-0">Bar Chart</strong>

            </div>
            <div class="card-body">

              <canvas id="barChartjs" width="" height="365px" ></canvas>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div> <!-- /. col -->
        <div class="col-md-4 mb-4">
          <div class="card shadow">
            <div class="card-header">
              <strong class="card-title mb-0">Categorys Name</strong>

            </div>
            <div class="card-body" style="max-height: 400px;" >
                <table class="table datatables" style="max-height: 350px;
                display: block;
                overflow-x: auto;" id="">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category name</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if ($categories->count())
                            @foreach ($categories as $categorie )
                            <tr>
                                <td>{{ $categorie->id }}</td>
                                <td>{{ $categorie->name }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div>
      </div>

      <div class="row my-4">
        <!-- Striped rows -->

          <div class="col-md-12 mb-4">
            <div class="card shadow">
              <div class="card-body">
                <!-- table -->
                <div class="card-header">
                  <strong class="card-title">Filter</strong>
                </div>
                <div class="card-body" >

                  <div class=" ">

                      <div class="form-row" >


                        <div class="form-group col-md-3">
                          <label for="multi-select2">Multiple Select</label>
                          <select class="form-control select2-multi user_name"  id="multi-select2">
                            <optgroup label="Mountain Time Zone">
                              @if ($users->isNotEmpty())
                              @foreach ($users as $user)
                                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                              @endforeach
                              @endif
                            </optgroup>
                          </select>
                        </div> <!-- form-group -->

                        <div class="form-group col-md-3">
                          <label for="inputState">Category</label>
                          <select id="" class="form-control post_category" name="category">
                            <option  value="" disabled  selected>All Category</option>
                            @if ($categories->isNotEmpty())
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            @endif
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="example-date">Start Date</label>
                          <input class="form-control start_date"  name="start_date" type="date" name="date">
                        </div>

                        <div class="form-group col-md-3">
                          <label for="example-date">End Date</label>
                          <input class="form-control end_date"  name="end_date" type="date" name="date">
                        </div>

                      </div>

                      <button type="button" class="btn btn-primary float-right fiterbtn "><span class="fe fe-filter fe-16 text-muted"></span></button>

                  </div>
                </div> <!-- / .card-body -->


                <div class="table-data">
                  @include('table')
                </div>


              </div>
            </div>
          </div> <!-- simple table -->


      </div> <!-- .row-->

    </div> <!-- .col-12 -->

</div> <!-- .row -->
--
<div class="row my-4">
    <div class="col-md-12 mb-4">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-header">
                    <strong class="card-title">Daily Publisher Tracker</strong>
                </div>
                <div class="card-body">

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="example-date">Start Date</label>
                                <input class="form-control s_start_date" name="s_start_date" type="date">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="example-date">End Date</label>
                                <input class="form-control s_end_date" name="s_end_date" type="date">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right searchbtn">
                            <span class="fe fe-filter fe-16 text-muted"></span> Search
                        </button>
                   
                </div>
            </div>
            <div class="table2-data">
                @include('table2')
            </div>
        </div>
    </div>
</div>


</div> <!-- .col-12 -->

</div> <!-- .row -->


@endsection

@push('script')
<script src="{{ asset('assets/js/apps.js') }}"></script>
<script>
    $(document).on('click','.fiterbtn',function(e){

        var user_count   =   $('.user_name').val();
        var category     =   $('.post_category').val();
        var start_date   =   $('.start_date').val();
        var end_date     =   $('.end_date').val();
        $('.lodder').removeClass('d-none');
      //  alert(user_count);
        $.ajax({
                url:"{{ route('filter.data') }}",
                type: "POST",
                data: {
                    user: user_count,
                    category:category,
                    start_date:start_date,
                    end_date:end_date,
                    _token: '{{csrf_token()}}'
                },

                success: function (data) {
                  $('.lodder').addClass('d-none');
                //  $('.short-by').html('Custom');
                    $('.table-data').html(data);
                }
        });
});
</script>

<script>
    $(document).on('click', '.searchbtn', function (e) {
        var s_start_date = $('.s_start_date').val();
        var s_end_date = $('.s_end_date').val();

        $.ajax({
            url: "{{ route('publisher.tracker') }}",
            type: "POST",
            data: {
                s_start_date: s_start_date,
                s_end_date: s_end_date,
                _token: '{{ csrf_token() }}'
            },
            success: function (data) {
                $('.table2-data').html(data);
            }
        });
    });
</script>

<script type="text/javascript">
 $(document).ready(function () {
    var ChartOptions = {
        maintainAspectRatio: !1,
        responsive: !0,
        legend: { display: !1 },
        scales: {
            xAxes: [{ gridLines: { display: !1 } }],
            yAxes: [
                {
                    gridLines: {
                        display: !1,
                        color: colors.borderColor,
                        zeroLineColor: colors.borderColor,
                    },
                },
            ],
        },
    },

    ChartData = {
        labels: {!! json_encode($mounth) !!},
        datasets: [
            {
                label: 'category' ,
                barThickness: 10,
                backgroundColor: base.primaryColor,
                borderColor: base.primaryColor,
                pointRadius: !1,
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: {!! json_encode($post_counts) !!},
                fill: "",
                lineTension: 0.1,
            },

        ],
    },

    barChartjs = document.getElementById("barChartjs");
barChartjs &&
    new Chart(barChartjs, {
        type: "bar",
        data: ChartData,
        options: ChartOptions,
    });

 });


</script>

@endpush
