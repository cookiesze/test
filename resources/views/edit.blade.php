@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <H1>เพิ่มสินค้า</H1>
                    {{-- <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                        <label for="name">Product Name:</label>
                        <input type="text" name="name" id="name" required>
                        </div>
                        <div class="col-md-6">
                        <label for="slug">Slug:</label>
                        <input type="text" name="slug" id="slug" required>
                        </div>
                        <div class="col-md-6">
                        <label for="price">Price:</label>
                        <input type="text" name="price" id="price" required>
                        </div>
                        <div class="col-md-6">
                        <label for="commission">Commission:</label>
                        <input type="text" name="commission" id="commission" required>
                        </div>
                        <div class="col-md-6">
                        <label for="ex_date">Expiration Date:</label>
                        <input type="date" name="ex_date" id="ex_date" required>
                        </div>
                        <div class="col-md-6">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" required></textarea>
                        </div>
                        <div class="col-md-6">
                        <label for="name_promotion">Promotion Name:</label>
                        <input type="text" name="name_promotion" id="name_promotion" required>
                        </div>
                        <div class="col-md-6">
                        <label for="image">Image:</label>
                        <input type="file" name="image" id="image" required>
                        </div>
                        <div class="col-md-6">
                        <label for="link">Link:</label>
                        <input type="text" name="link" id="link" required>
                        </div>
                        <div class="col-md-6">
                        <label for="status">Status:</label>
                        <select name="status" id="status" required>
                            <option value="Enabled">Enabled</option>
                            <option value="Disabled">Disabled</option>
                        </select>
                        </div>
                        <button type="submit">Create Product</button>
                    </form> --}}
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Add form fields here -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">ชื่อสินค้า</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}"required >
                            </div>
                            <div class="col-md-6">
                                <label for="">ชื่อสินค้าอีกครั้ง</label>
                                <input type="text" name="slug" id="slug" class="form-control"  value="{{ $product->slug }}"required >
                            </div>
                            <div class="col-md-6">
                                <label for="">ราคา</label>
                                <input type="text" name="price" id="price" class="form-control"  value="{{ $product->price }}"required >
                            </div>
                            <div class="col-md-6">
                                <label for="">ค่าคอม</label>
                                <input type="text" name="commission" id="commission" class="form-control"  value="{{ $product->commission }}" required readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="">วันหมดอายุ</label><br>
                                <input type="date" name="ex_date" id="ex_date" value="{{ $product->ex_date }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">สินต้าโปรโมชั่น</label>
                                <input type="text" name="name_promotion" id="name_promotion" class="form-control" value="{{ $product->name_promotion }}" required >
                            </div>
                            <div class="col-md-12 mb-3 form-group">
                                <label for="">link</label>
                                <input type="text" class="form-control" value="https://www.google.com/" name="link" id="link" value="{{ $product->link }}" required>
                            </div>
                            <div class="col-md-12 mb-3 form-group">
                                <label for="">Description</label>
                                <input type="text" class="form-control" name="description" value="description"value="{{ $product->description }}" required>
                            </div>
                            <div class="col-md-12 form-group">
                                    <label>เปิด - ปิด กาารใช้งาน</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="Enabled" @if ($product->status == 'Enabled') selected @endif>เปิดใช้งาน</option>
                                        <option value="Disabled" @if ($product->status == 'Disabled') selected @endif> ปิดใช้งาน</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @if ($product->image)
                                <br>
                                    <img src="{{ asset('assets/uploads/products/images/'.$product->image) }}" style="width: 300px;" class="edit-image" alt="">
                                    <br>
                                    <div class="p-2 small">
                                        <div>{{ $product->image }}</div>
                                        @php
                                        $filePath = 'assets/uploads/products/images/'.$product->image;
                                        $fileSize = filesize(public_path($filePath));

                                        // Define an array of human-readable file size units
                                        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

                                        // Calculate the file size in human-readable format
                                        $humanSize = $fileSize > 0 ? round($fileSize / pow(1024, ($exp = floor(log($fileSize, 1024)))), 2) . ' ' . $units[$exp] : '0 B';
                                    @endphp
                                        <div class="text-muted">File Size: {{ $humanSize }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">Upload Photo (Product Image)</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">edit Product</button>
                          </div>
                          @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection
