@extends('layouts.appf')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        </div>

        <div class="col-md-12" style="background-color: #33ACFF;">
            <img class="img-fluid" alt="Responsive image" src="{{ asset('assets/head.jpg') }}" style="width: 100%; padding: 15px;" class="edit-image" alt="">
            <div style="text-align: center"><br>
                <h1> สินค้าทั้งหมด</h1>
            </div>
            {{-- </div>
            <div class="input-group">
                <div class="form-floating">
                    <input class="form-control" type="search" id="form1" name="search_name" value="{{ request('search_name') }}" />
                  <label for="form1">Search</label>
                </div>
                <button type="button" class="btn btn-primary" onclick="copySearchText()">
                  <i class="fas fa-search"></i>
                </button>
              </div> --}}
            <div class="card-body">
                @foreach ($products as $product)
                    <div class="row">
                        <h4 style="font-family: 'Kanit';">{{ $product->name }}</h4>
                        <div class="col-md-6">
                            <img class="img-fluid" alt="Responsive image"
                                src="{{ asset('assets/uploads/products/images/' . $product->image) }}" style="width: 100%;"
                                class="edit-image" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <br><br>
                                <p style="font-family: 'Kanit';"><br> หมดอายุ :
                                    {{ \Carbon\Carbon::parse($product->ex_date)->addYears(543)->format('d-m-Y') }}<br>

                                    ราคา : {{ $product->price }} <br>
                                    ค่าคอม :</strong> {{ $product->commission }}</p>
                            </div>
                            <div class="row">
                                <input type="text" value="{{ $product->link }}" class="myInput" readonly hidden>
                                <button class="btn btn-primary" onclick="copyLink(this)"
                                    style="width: 150px">คัดลอกลิงก์</button>
                            </div>
                        </div>
                    </div><br>
                @endforeach
            </div>
        </div>

        <br>

    </div>
@endsection
