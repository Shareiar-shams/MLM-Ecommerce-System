<form action="{{ route('admin.product.item.index') }}" method="GET">
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label>Product Type :</label>
                <select class="select2" name="productType" style="width: 100%;">
                    <option value="" selected>All Product</option>
                    <option value="physical">Physical Product</option>
                    <option value="affiliate">Affiliate Product</option>
                    <option value="customize">Customize Product</option>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Tags:</label>
                <select class="select2" name="is_type" style="width: 100%;">
                    <option value="" selected>All Tags</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Categories:</label>
                <select class="select2" name="category" style="width: 100%;">
                    <option value="" selected>All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Status:</label>
                <select class="select2" name="status" style="width: 100%;">
                    <option selected value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="reset" class="btn btn-danger" onclick="location.reload()">Reset</button>
        <button type="submit" class="btn btn-primary">Filter Product</button>
    </div>
</form>