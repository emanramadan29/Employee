
        <footer id="footer" class="bg-one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @if(count($socialss) > 0)
                        <!-- Footer Social Links -->
                        <div class="social-icon">
                            <ul>
                                @foreach($socialss as $social)
                                <li><a target="_blank" href="{{$social->link}}"><i class="fa fa-{{$social->name}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/. End Footer Social Links -->
                        @endif

                        <!-- copyright -->
                        <div class="copyright text-center">
                            <a href="/">
                                <img src="{{asset('img/logo.png')}}" alt="Orange" /> 
                            </a>
                            <br />
                            
                            <p>Design And Developed by <a href="http://orangesw.com/"> Orange Soft Team</a>. Copyright &copy; 2018. All Rights Reserved.</p>
                        </div>
                        <!-- /copyright -->
                        
                    </div> <!-- end col lg 12 -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </footer> <!-- end footer -->
        