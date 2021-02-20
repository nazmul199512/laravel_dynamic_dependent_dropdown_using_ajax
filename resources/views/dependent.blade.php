@extends('layouts.app')

@section('content')
    <body>
    <br />
    <div class="container box">
        <h3 align="center">Ajax Dynamic Dependent Dropdown in Laravel</h3><br />
        <div class="form-group">
            <select name="country" id="country" class="form-control input-lg dynamic" data-dependent="state">
                <option value="">Select Country</option>
                @foreach($country_list as $country)
                    <option value="{{ $country->country}}">{{ $country->country }}</option>
                @endforeach
            </select>
        </div>
        <br />
        <div class="form-group">
            <select name="state" id="state" class="form-control input-lg dynamic" data-dependent="city">
                <option value="">Select State</option>
            </select>
        </div>
        <br />
        <div class="form-group">
            <select name="city" id="city" class="form-control input-lg">
                <option value="">Select City</option>
            </select>
        </div>
        {{ csrf_field() }}
        <br />
        <br />
    </div>
    </body>

    <script>
        $(document).ready(function(){

            $('.dynamic').change(function(){
                if($(this).val() != '')
                {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('DynamicDependent.fetch') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result)
                        {
                            $('#'+dependent).html(result);
                        }

                    })
                }
            });

            $('#country').change(function(){
                $('#state').val('');
                $('#city').val('');
            });

            $('#state').change(function(){
                $('#city').val('');
            });


        });

    </script>


@endsection
