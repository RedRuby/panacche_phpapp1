@foreach($products as $product)
<div class="col-12 float-left mt-1 px-0 addmerchBoxWrap">
    <label for="" class="col-12 px-0 mt-3 mb-0">1</label>

    <div class="row addmerchBox borderradius6 mt-1 mx-0 pt-3">
        <div class="col-md-4 float-left">
            <p>Merchandise</p>
            <p>{{ $product->title }} </p>
            <p>Description (Sourcing / Vendor)</p>
            <p>{{ $product->description }}</p>

            <div class="col-6 px-0 float-left colorVariants">
                <p class="mb-1">Quantity</p>
                <p>{{ $product->quantity }}</p>
            </div>
        </div>
        <div class="col-md-4 float-left">
            <p>Size Specification</p>
            <p>{{ $product->size_specification }}</p>
            <p>URL</p>
            <p>{{ $product->product_url }}</p>
            <div class="col-6 px-0 float-left">
                <p>Price</p>
                <p>$ {{ $product->product_price }}</p>
            </div>
            <div class="col-6 px-0 float-left colorVariants">
                <p>Compare at Price </p>
                <p>$ {{ $product->product_compare_at_price }}</p>
            </div>
        </div>
        <div class="col-md-4 float-left">
            <p>Upload Image Reference
                <span class="deleteUpload"><i class="fas fa-times-circle"></i></span>
            </p>
            <p class="border border-light"><img src="images/upload_mearch_Img1.jpg" class="img-fluid"></p>
            <div class="row uploadedImage px-0">
                <div class="col-4 float-left">
                    <p><img src="images/upload_mearch_Img1.jpg"></p>
                </div>
                <div class="col-4 float-left">
                    <p><img src="images/upload_mearch_Img1.jpg"></p>
                </div>
                <div class="col-4 float-left">
                    <p><img src="images/upload_mearch_Img1.jpg"></p>
                </div>
                <div class="col-4 float-left">
                    <p><img src="images/upload_mearch_Img1.jpg"></p>
                </div>
                <div class="col-4 float-left">
                    <p><img src="images/upload_mearch_Img1.jpg"></p>
                </div>
                <div class="col-4 float-left">
                    <p><img src="images/upload_mearch_Img1.jpg"></p>
                </div>
            </div>

            <p class="text-right"><button type="submit" class="btn btn-primary loginBtn">Edit</button></p>
        </div>
    </div>
</div>
@endforeach
