@extends('layout.layout')
@section('content')
<style>
  body { font-family: DejaVu Sans, sans-serif; }
  thead,tbody{
      background: #FF9138;
      box-shadow: 0px 0px 6px #E7E9F2;
  }
  .table tbody tr:nth-child(odd)
{
    background-color: #fff;
}
.table tbody tr:nth-child(even)
{
    background-color: #FFF2E7;
}
</style>
<div style="padding: 12px 16px; width: 100%">
    <div class="table">
        <table>
            <thead>
               <tr>
                   <th class="bd-radius-topleft10">Số thứ tự</th>
                   <th>Tên dịch vụ</th>
                   <th>Thời gian cấp</th>
                   <th>Tình trạng</th>
                   <th class="bd-radius-topright10">Nguồn cấp</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($stt as $item)
                <tr>
                    <td>{{ $item->serial }}</td>
                    <td>{{ $item->service_name }}</td>
                    <td >{{ $item->created_at }}</td>
                    @if($item->status == -1)
                    <td ><i class="dot dot-fire"></i><p>Đã bỏ qua</p></td>
                    @elseif ($item->status == 0)
                    <td ><i class="dot dot-water"></i><p>Đang chờ</p></td>
                    @elseif ($item->status == 1)
                    <td ><i class="dot dot-jungle"></i><p>Đã sử dụng</p></td>
                    @endif
                    <td>{{ $item->equipment_name }}</td>
                  </tr>  
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
