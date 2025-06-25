@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Orders List</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">

                    <div class="mb-3">
                        <a href="{{ route('admin.orders') }}" class="btn btn-secondary btn-sm {{ $status == null ? 'active' : '' }}">All</a>
                        <a href="{{ route('admin.orders', ['status' => 'pending']) }}" class="btn btn-warning btn-sm {{ $status == 'pending' ? 'active' : '' }}">Pending</a>
                        <a href="{{ route('admin.orders', ['status' => 'completed']) }}" class="btn btn-success btn-sm {{ $status == 'completed' ? 'active' : '' }}">Completed</a>
                        <a href="{{ route('admin.orders', ['status' => 'cancelled']) }}" class="btn btn-danger btn-sm {{ $status == 'cancelled' ? 'active' : '' }}">Cancelled</a>
                    </div>

                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Payment Method</th>
                            <th>Total Price</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->name }} {{ $order->last_name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>PKR {{ number_format($order->total_price) }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>

                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($order->status == 'completed')
                                        <span class="badge badge-success">Completed</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge badge-danger">Cancelled</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>

                                <td>
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="form-control">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No orders found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
