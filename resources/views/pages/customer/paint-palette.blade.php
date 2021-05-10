<div  class="col-12 float-left p-4 shoppingList mt-3">
   <div class="col-12 px-0 landingHeading">
      <h4 class="mb-4">
         <span>Paint Palette</span>
      </h4>
   </div>
   <div class="row px-3">
      <div class="col-md-12 float-left tab2dragDropBox dragandDropWrap rounded-0 responsiveTableWrap">
         <div class="col-md-12 col-xs-12 float-left px-0">
            <table class="table colorPaintTable buyColorPaintTable mb-0">
               <tbody>
                  @foreach ($colorPallettes as $pkey => $colorPallette)
                     <tr>
                        <td>
                           <div class="col-12 text-center">
                              <p class="custom-file paintColor">
                                 <img src="{{asset('uploads/'.$colorPallette->color_img)}}">
                              </p>
                           </div>
                        </td>
                        <td>
                           <p class="mb-0">Color Name</p>
                           <p class="mb-0">{{$colorPallette->color_name}}</p>
                        </td>
                        <td>
                           <p class="mb-0">Brand</p>
                           <p class="mb-0">{{$colorPallette->brand}}</p>
                        </td>
                        <td>
                           <p class="mb-0">Finish</p>
                           <p class="mb-0">{{$colorPallette->finish}}</p>
                        </td>
                        <td>
                           <p class="mb-0">Application</p>
                           <p class="mb-0">{{$colorPallette->application}}</p>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>