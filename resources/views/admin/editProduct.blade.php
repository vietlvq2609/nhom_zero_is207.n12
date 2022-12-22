<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="dis-user">
        <div class="card user-card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Cập nhật sản phẩm</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('updateProduct', ['product' => $product])}}" method="POST">
                    @csrf 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" class="form-control" value="{{$product->name}}" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <input type="text" class="form-control" value="{{$product->description}}" name="description" id="description">
                            </div>
                            <div class="form-group">
                                <label for="image">Hình ảnh minh họa</label>
                                <input type="text" class="form-control" value="{{$product->product_image}}" name="image" id="image">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-success mt-2" type="submit">Lưu</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>