 @props(['university', 'wow_delay' => '0.1'])


 <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $wow_delay }}s">
     <div class="course-item bg-light">
         <div class="position-relative overflow-hidden">
             <img class="img-fluid" src="{{ asset('img/university/' . $university->image_path) }}" alt="">
             <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                 <a href="{{ route('university.show', $university->id) }}"
                     class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end"
                     style="border-radius: 30px 0 0 30px;">Read More</a>
                 <a href="{{ route('application.create', $university->id) }}"
                     class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Apply
                     Now</a>
             </div>
         </div>
         <div class="text-center p-4 pb-0">
             <h3 class="mb-0">{{ $university->name }}</h3>
             <h5 class="mb-3">{{ $university->short_address }}</h5>
             <div class="mb-4">
                 <small> Rating: 7.0/10</small>
                 <small>(123)</small>
             </div>
         </div>
         <div class="d-flex border-top">
             <small class="flex-fill text-center border-end py-2"><i class="fas fa-book text-primary me-2"></i>XX
                 Majors</small>
             <small class="flex-fill text-center border-end py-2"><i class="fa fa-dollar-sign text-primary me-2"></i> XX
                 Scholership</small>
             <small class="flex-fill text-center py-2"><i
                     class="fa fa-user text-primary me-2"></i>{{ $university->total_students }}
                 Students</small>
         </div>
     </div>
 </div>
