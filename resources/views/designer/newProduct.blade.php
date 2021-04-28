@foreach($products as $key=>$product)
<div class="col-12 float-left mt-1 px-0 addmerchBoxWrap product-preview-section">
    <label for="" class="col-12 px-0 mt-3 mb-0">{{ $key + 1 }}</label>

    <div class="row addmerchBox borderradius6 mt-1 mx-0 pt-3">
        <div class="col-md-4 float-left">
            <p>Merchandise</p>
            <p>{{ $product->title }} </p>
            <p>Sourcing / Vendor</p>
            <p>{{ $product->vendor->vendor_name }}</p>

            <div class="col-6 px-0 float-left colorVariants">
                <p class="mb-1">Quantity</p>
                <p>{{ $product->product_quantity }}</p>
            </div>
        </div>
        <div class="col-md-4 float-left">
            <p>Size Specification</p>
            <p>{{ $product->size_specification }}</p>
            <p>URL</p>
            <p>{{ $product->product_url }}</p>
            <div class="col-6 px-0 float-left">
                <p>Retail Price</p>
                <p>$ {{ $product->product_price }}</p>
            </div>
            <!--<div class="col-6 px-0 float-left colorVariants">
                <p>Compare at Price </p>
                <p>$</p>
            </div>-->
        </div>
        <div class="col-md-4 float-left">
            <p>Upload Image Reference
                <span class="deleteUpload"><i class="fas fa-times-circle"></i></span>
            </p>
            <!--<p class="border border-light"><img src="images/upload_mearch_Img1.jpg" class="img-fluid"></p>-->
            <div class="row uploadedImage px-0">
                @foreach ($product->productImages as $key=>$productImage )
                    <div class="col-12 float-left">
                        <p><img src="{{ asset('/uploads/collection/'.$collection->id.'/'.$product->productImages->first()->img_src) }}" class="img-fluid"></p>
                    </div>
                @endforeach

            </div>

            <p class="text-right"><button type="submit" class="btn btn-primary loginBtn edit-product-btn">Edit</button></p>
        </div>
    </div>

    <div class="col-12 addMearchForm py-3 px-0 update-product-section float-left hide">
        <form class="mx-0 update-product-form">
            <input type="hidden" name="customer_id" value="{{ $customer->id }}" />
            <input type="hidden" name="shop" value="{{ env('Shop_NAME')}}" />
            <input type="hidden" name="collection_id" value="{{ $collection->id }}" id="collection_id">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 float-left">
                <div class="form-group">
                    <label for="">Merchandise</label>
                    <input type="text" class="form-control" placeholder="" name="merchandise" value="{{ $product->title }}">
                    <span class="validation_error"></span>
                </div>

                <div class="form-group">
                    <label for="">Vendor</label>
                <input type="text" class="form-control vendor_id" placeholder="" name="vendor_id" id="vendor_id" list="vendor-datalist" value="{{ $product->vendor->vendor_name }}">
                    <datalist id="vendor-datalist" class="vendor-datalist">
                        @foreach ($vendors as $vendor)
                        <option @if($product->vendor->id == $vendor->id) selected @endif data-value="{{ $vendor->id }}" value="{{ $vendor->vendor_name }}"></option>
                    @endforeach
                    </datalist>

                    <button type="button" class="btn btn-secondary mr-3 w-100 loginBtn" data-toggle="modal" data-target="#addVenderPop"><i class="fas fa-plus-circle mr-2" aria-hidden="true"></i> Add New Vendor</button>
                </div>


                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="number" class="form-control" name="quantity" step="3" value="{{ $product->product_quantity }}">
                    <span class="validation_error"></span>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 float-left">
                <div class="form-group">
                    <label for="">Specification</label>
                    <input type="text" class="form-control" placeholder="" name="size_specification" value="{{ $product->size_specification }}">
                    <span class="validation_error"></span>
                </div>
                <div class="form-group">
                    <label for="">URL</label>
                    <input type="text" class="form-control" placeholder="" name="product_url" value="{{ $product->product_url }}">
                    <span class="validation_error"></span>
                </div>
                <div class="form-group">
                    <label for="">Retail Price</label>
                    <input type="number" class="form-control" placeholder="$" name="product_price" value="{{ $product->product_price }}">
                    <span class="validation_error"></span>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 float-left">
                <div class="form-group">
                    <label for="">Upload Image Reference <span class="deleteUpload deleteUpload2"><i class="fas fa-times-circle" aria-hidden="true"></i></span></label>
                    <div class="imageRefUpload p-3 col-12 float-left">

                        <div class="col-12 float-left px-0">
                            <p>Drag and Drop Image/ Browse Files</p>
                            <p class="custom-file mb-0 addImage" style="background-image: url(&quot;blob:https://panacchebeta.myshopify.com/ccf1760d-cb18-446f-8650-fdbf0e74d25b&quot;);">
                                <input type="file" class="custom-file-input" id="product_images" name="product_images[]" accept="image/x-png,image/gif,image/jpeg">
                                <span class="validation_error"></span>
                                <label class="custom-file-label2 mb-0" for="customFile"></label>
                            </p>
                        </div>
                        <div class="row uploadedImage px-0" id="uploadProductImages">
                        </div>

                    </div>
                </div>

            </div>

            <p class="text-right px-3 pt-3 float-right">
                <button type="submit" class="btn btn-primary loginBtn update-product-btn" data="{{ $product->id }}">Update</button>
            <button type="button" class="btn btn-default loginBtn cancel-product-btn">Cancel</button></p>

        </form>
    </div>
</div>
@endforeach

