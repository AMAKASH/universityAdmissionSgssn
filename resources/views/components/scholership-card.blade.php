 @props(['scholership', 'wow_delay' => '0.1'])

 <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ $wow_delay }}s">
     <div class="team-item bg-light">
         <div class="overflow-hidden">
             <img class="img-fluid" src="{{ asset('img/university/' . $scholership->university->image_path) }}"
                 alt="">
         </div>
         <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
             <div class="bg-light d-flex justify-content-center pt-2 px-1">
                 <a class="btn btn-sm-square btn-primary mx-1"
                     href="{{ route('university.show', $scholership->university->id) }}"><i
                         class="fa fa-university"></i></a>
                 <a class="btn btn-sm-square btn-primary mx-1"
                     href="{{ route('scholership.show', $scholership->id) }}"><i class="fa fa-globe"></i></a>

             </div>
         </div>
         <div class="text-center p-4">
             <h5 class="mb-0">{{ $scholership->name }}</h5>
             <small>{{ $scholership->university->name }}</small>
         </div>
     </div>
 </div>
