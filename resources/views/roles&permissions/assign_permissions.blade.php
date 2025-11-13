
@extends('layout.master')
@section('title', 'Assign Permissions to Roles')

@section('content')

    <form  id="kpi_form" action="" method="post">
        @csrf
        <div class="card container">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row-cols-6">

                        <select name="employee_id" class="employees form-control p-2">
                            <option value="" selected disabled>Choose Role</option>
                            @foreach()
                                <option value="{{}}">{{  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div >

                        <input type="checkbox" >

                        <div class="row justify-content-end m-4">
                            <div class=" m-2 ">
                                <button type="submit" name="action"  value="submit_later" id="submit_later" class="btn btn-outline-dark"> Submit For Later</button>
                            </div>

                            <div class=" m-2">
                                <button type="submit"  name="action" value="final_submit" id="final_submit" class="btn btn-outline-dark">Final Submit</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>


        </div>
    </form>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
           $.ajax({
               url:'{{route('')}}',
               success:function(response){

               }
           });



        });



    </script>



@endsection

