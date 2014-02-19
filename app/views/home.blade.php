@extends('layout.main')

@section('content')
@if(Auth::check())
<p>Hello, {{ Auth::user()->real_name }} </p>
@else
<p> You are not sign in. </p>
@endif


<div id="pagewidth">     
    <div id="wrapper" class="clearfix">

        <div id="maincol">



            <!-- CALENDAR -->
            <div id="example-cal" >
                <div id="background">
                    <div id="calendar"></div>
                </div>
                <script>
                    $(document).ready(function() {
                        var currentDate = new Date();                       
                        // create Calendar from div HTML element
                        $("#calendar").kendoCalendar({
                            value: currentDate                            
                        });
                    });
                </script>
                <style scoped>
                    #background {
                        width: 100%;
                        height:100%;
                        margin: 0 auto;
                        padding:0;
                        background: none;
                        border:none;
                    }
                    #calendar {
                        width: 100%;
                        height:100%;
                        min-height:300px;
                        margin: 0 auto;
                        padding:0;
                        border:1px solid #ccc;
                        border-top:1px solid #333;
                    }
                </style>
            </div>
            <br />
            <p align="right"><a href="#">Please Login to add new event &#155;</a></p>
        </div>  <!-- /maincol -->


        <div id="leftcol">  			 
            <h2 class="ttl">News</h2>
            <div class="leftcol">

                <div class="article">
                    <p class="date"><span>27/11/2013</span></p> 
                    <p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. <a href="#">[more]</a></p>
                </div>
                <div class="article">
                    <p class="date"><span>27/11/2013</span></p> 
                    <p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. <a href="#">[more]</a></p>
                </div> 

                <p align="right"><a href="#">All News &#155;</a></p>


            </div></div><!-- /maincol -->


    </div>  <!-- /wrapper -->

</div>   <!-- /pagewidth -->

<div id="footer">
    <p>@Copyright Music site</p>
</div><!-- /footer -->
@stop