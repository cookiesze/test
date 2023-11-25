@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <H1>สินค้าทั้งหมด</H1>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">ราคา/คอม</th>
                            <th scope="col">action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($products as $items)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $items->name }}</td>
                                <td>{{ $items->price }}/{{ $items->commission }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{ url('edit/'.$items->id) }}"><i class="fa fa-gears"></i> แก้ไข</a>
                                    <a class="btn btn-danger" href="{{ url('delete/'.$items->id) }}" onclick="return confirm('คุณต้องการลบข้อมูลนี้จริงหรือไม่?');"><i class="fa fa-times-circle"></i> Delete</a>
                                </td>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
        </div>
    </div>
</div>
@endsection
