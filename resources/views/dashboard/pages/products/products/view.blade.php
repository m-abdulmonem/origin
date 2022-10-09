  @extends('dashboard.layouts.app')
  @section('content')
      <!-- Default box -->
      <div class="card card-solid">
          <div class="card-body">
              <div class="row">
                  <div class="col-12 col-sm-6">
                      <h3 class="d-inline-block d-sm-none">{{ ucwords($product->title) }}</h3>
                      <div class="col-12">
                          <img src="../../dist/img/prod-1.jpg" class="product-image" alt="Product Image">
                      </div>
                      <div class="col-12 product-image-thumbs">
                          <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image">
                          </div>
                          <div class="product-image-thumb"><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
                          <div class="product-image-thumb"><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
                          <div class="product-image-thumb"><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
                          <div class="product-image-thumb"><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
                      </div>
                  </div>
                  <div class="col-12 col-sm-6">
                      <h3 class="my-3">{{ ucwords($product->title) }}</h3>
                      <p>{{ucfirst($product->description)}}</p>

                      <hr>
                      @foreach($product->variants as $variant)
                          <h4>Available {{$variant->title}}s</h4>
                          <div class="btn-group btn-group-toggle" data-toggle="buttons">
                              @foreach($variant->slugs as $key => $slug)
                                  <label class="btn btn-default text-center {{ $key == 0? "active" : "" }}">
                                      <input type="radio" name="{{ $variant }}_option" id="{{ $variant }}_option_a{{$key}}" autocomplete="off" {{ $key == 0? "checked" : "" }}>
                                      {{ ucwords($slug->slug) }}
                                      <br>
                                      Quantity : {{ $slug->value }}
                                      <br>
                                      <i class="fas fa-circle fa-2x text-{{ $slug->slug }}"></i>
                                  </label>
                              @endforeach
                          </div>
                      @endforeach


                      <div class="bg-gray py-2 px-3 mt-4">
                          <h2 class="mb-0">
                              @lang("Sale Price : ", ['price' => $product->sale_price])
                          </h2>
                          <h4 class="mt-0">
                              <small>@lang("Buy Price : ", ['price' => $product->buy_price]) </small>
                          </h4>
                      </div>
                  </div>
              </div>
              <div class="row mt-4">
                  <nav class="w-100">
                      <div class="nav nav-tabs" id="product-tab" role="tablist">
                          <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab"
                              href="#product-desc" role="tab" aria-controls="product-desc"
                              aria-selected="true">Description</a>
                          <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab"
                              href="#product-comments" role="tab" aria-controls="product-comments"
                              aria-selected="false">Comments</a>
                          <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating"
                              role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                      </div>
                  </nav>
                  <div class="tab-content p-3" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                          aria-labelledby="product-desc-tab"> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                          Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices

             posuere cubilia Curae; Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a
                          eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel.
                          Suspendisse mi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus purus sed
                          venenatis. Vivamus varius metus quam, id dapibus velit mattis eu. Praesent et semper risus.
                          Vestibulum erat erat, condimentum at elit at, bibendum placerat orci. Nullam gravida velit mauris,
                          in pellentesque urna pellentesque viverra. Nullam non pellentesque justo, et ultricies neque.
                          Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque interdum efficitur nunc vitae
                          consectetur. Suspendisse venenatis, tortor non convallis interdum, urna mi molestie eros, vel
                          tempor justo lacus ac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel metus.
                      </div>
                      <div class="tab-pane fade" id="product-comments" role="tabpanel"
                          aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed
                          condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo
                          lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit,
                          consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget
                          porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem,
                          vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices
                          venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex
                          ullamcorper, ornare velit vel, tincidunt ipsum. </div>
                      <div class="tab-pane fade" id="product-rating" role="tabpanel"
                          aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In
                          hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla
                          iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat
                          sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam
                          ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie
                          lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo.
                          Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius
                          consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor
                          vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae
                          vehicula placerat. </div>
                  </div>
              </div>
          </div>
          <!-- /.card-body -->
      </div>
      <!-- /.card -->
  @endsection
